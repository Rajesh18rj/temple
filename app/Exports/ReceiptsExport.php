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
use PhpOffice\PhpSpreadsheet\Style\Alignment;
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

    public function __construct(?Builder $query = null)
    {
        $this->query = $query;

        $this->categories = Category::orderBy('display_order')
            ->orderBy('name')
            ->get();
    }

    public function query()
    {
        $query = $this->query ?? Receipt::query();

        return $query
            ->with([
                'city',
                'receiptDetails.category',
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
            'Mobile',
            'City',
            'Address',
            'Date',
        ];

        foreach ($this->categories as $category) {
            $headings[] = $category->name;
        }

        $headings[] = 'Total Amount';

        return $headings;
    }

    public function map($receipt): array
    {
        $row = [
            $receipt->receipt_number,
            $receipt->name,
            $receipt->mobile ?? '-',
            $receipt->city?->name ?? '-',
            $receipt->address ?? '-',
            $receipt->date
                ? $receipt->date->format('d-m-Y')
                : '-',
        ];

        $total = 0;

        foreach ($this->categories as $category) {

            $detail = $receipt->receiptDetails
                ->firstWhere('category_id', $category->id);

            $amount = $detail
                ? (float) $detail->amount
                : 0;

            $row[] = $amount;

            $total += $amount;
        }

        $row[] = $total;

        return $row;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                /*
                |--------------------------------------------------------------------------
                | Last receipt row
                |--------------------------------------------------------------------------
                */

                $lastReceiptRow = $sheet->getHighestRow();

                /*
                |--------------------------------------------------------------------------
                | Total row
                |--------------------------------------------------------------------------
                */

                $totalRow = $lastReceiptRow + 1;

                $sheet->setCellValue(
                    "A{$totalRow}",
                    'Category Total'
                );

                /*
                |--------------------------------------------------------------------------
                | Calculate totals directly from database
                |--------------------------------------------------------------------------
                */

                $query = $this->query ?? Receipt::query();

                $receipts = $query
                    ->with('receiptDetails')
                    ->get();

                /*
                |--------------------------------------------------------------------------
                | Category totals
                |--------------------------------------------------------------------------
                */

                $categoryStartColumn = 7; // G

                foreach ($this->categories as $index => $category) {

                    $total = 0;

                    foreach ($receipts as $receipt) {

                        $detail = $receipt->receiptDetails
                            ->firstWhere(
                                'category_id',
                                $category->id
                            );

                        if ($detail) {
                            $total += (float) $detail->amount;
                        }
                    }

                    $column = $this->columnLetter(
                        $categoryStartColumn + $index
                    );

                    $sheet->setCellValue(
                        "{$column}{$totalRow}",
                        $total
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Grand Total
                |--------------------------------------------------------------------------
                */

                $grandTotal = 0;

                foreach ($receipts as $receipt) {

                    $grandTotal += $receipt->receiptDetails
                        ->sum(function ($detail) {
                            return (float) $detail->amount;
                        });
                }

                $totalColumn = $this->columnLetter(
                    $categoryStartColumn + $this->categories->count()
                );

                $sheet->setCellValue(
                    "{$totalColumn}{$totalRow}",
                    $grandTotal
                );

                /*
                |--------------------------------------------------------------------------
                | Style total row
                |--------------------------------------------------------------------------
                */

                $highestColumn = $sheet->getHighestColumn();

                $sheet->getStyle(
                    "A{$totalRow}:{$highestColumn}{$totalRow}"
                )->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'EDE9FE',
                        ],
                    ],
                    'borders' => [
                        'top' => [
                            'borderStyle' =>
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ]);
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
