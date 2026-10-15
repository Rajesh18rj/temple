<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Receipt;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReceiptsExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithCustomStartCell,
    WithEvents
{
    protected ?Builder $query;

    protected $categories;

    public function __construct(?Builder $query = null, ?int $categoryId = null)
    {
        $this->query = $query;

        $categoriesQuery = Category::with('parent')
            ->where(function ($query) {
                $query->whereNotNull('parent_id')
                    ->orWhereDoesntHave('children');
            });

        if ($categoryId) {
            $categoriesQuery->where('id', $categoryId);
        }

        $this->categories = $categoriesQuery
            ->orderByRaw('COALESCE(parent_id, id) ASC')
            ->orderByRaw('CASE WHEN parent_id IS NULL THEN 0 ELSE 1 END ASC')
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();
    }


    public function query()
    {
        $query = $this->query ?? Receipt::query();

        return $query
            ->with([
                'city',
                'receiptDetails.category.parent',
            ])
            ->latest();
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function headings(): array
    {
        $headings = [
            'Receipt No',
            'Name',
            'Date',
            'Mobile',
            'Address',
            'City',
        ];

        foreach ($this->categories as $category) {
            $parentName = $category->parent?->name;

            $headings[] = $parentName
                ? $parentName . ' - ' . $category->name
                : $category->name;
        }

        // Show Total Amount only when no category filter is applied
        if (!$this->query || !request()->filled('category_id')) {
            $headings[] = 'Total Amount';
        }

        return $headings;
    }
    public function map($receipt): array
    {
        $row = [
            $receipt->receipt_number,
            $receipt->name,
            $receipt->date
                ? $receipt->date->format('d-m-Y')
                : '-',
            $receipt->mobile ?? '-',
            $receipt->address ?? '-',
            $receipt->city?->name ?? '-',
        ];

        $total = 0;

        foreach ($this->categories as $category) {
            $detail = $receipt->receiptDetails
                ->firstWhere('category_id', $category->id);

            $amount = $detail ? (float) $detail->amount : 0;

            $row[] = $amount;
            $total += $amount;
        }

// Include Total Amount only when no category filter is applied
        if (!request()->filled('category_id')) {
            $row[] = $total;
        }

        return $row;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Last data row and totals row.
                $lastReceiptRow = $sheet->getHighestRow();
                $totalRow = $lastReceiptRow + 1;

                $sheet->setCellValue("F{$totalRow}", 'Total');

                // Use the same receipt query and filters as the export.
                $query = $this->query ?? Receipt::query();

                $receipts = (clone $query)
                    ->with('receiptDetails')
                    ->get();

                // Category columns start at G.
                $categoryStartColumn = 7;

                foreach ($this->categories as $index => $category) {
                    $categoryTotal = 0;

                    foreach ($receipts as $receipt) {
                        $detail = $receipt->receiptDetails
                            ->firstWhere(
                                'category_id',
                                $category->id
                            );

                        if ($detail) {
                            $categoryTotal += (float) $detail->amount;
                        }
                    }

                    $column = $this->columnLetter(
                        $categoryStartColumn + $index
                    );

                    $sheet->setCellValue(
                        "{$column}{$totalRow}",
                        $categoryTotal
                    );
                }

                // Grand total across all receipt details.

                /*
                |--------------------------------------------------------------------------
                | Grand Total
                |--------------------------------------------------------------------------
                | Show the grand total only when no category filter is applied.
                */

                if (!request()->filled('category_id')) {
                    $grandTotal = 0;

                    foreach ($receipts as $receipt) {
                        $grandTotal += $receipt->receiptDetails
                            ->sum(fn ($detail) => (float) $detail->amount);
                    }

                    $totalColumn = $this->columnLetter(
                        $categoryStartColumn + $this->categories->count()
                    );

                    $sheet->setCellValue(
                        "{$totalColumn}{$totalRow}",
                        $grandTotal
                    );
                }


                // Style the totals row.
                $highestColumn = $sheet->getHighestColumn();

                $sheet->getStyle(
                    "A{$totalRow}:{$highestColumn}{$totalRow}"
                )->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'EDE9FE',
                        ],
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // Bold the column headings.
                $sheet->getStyle(
                    'A1:' . $highestColumn . '1'
                )->getFont()->setBold(true);

                // Freeze the heading row.
                $sheet->freezePane('A2');
            },
        ];
    }

    private function columnLetter(int $columnNumber): string
    {
        $letter = '';

        while ($columnNumber > 0) {
            $remainder = ($columnNumber - 1) % 26;

            $letter = chr(65 + $remainder) . $letter;

            $columnNumber = (int) (($columnNumber - 1) / 26);
        }

        return $letter;
    }
}
