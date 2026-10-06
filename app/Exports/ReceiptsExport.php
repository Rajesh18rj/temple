<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Receipt;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReceiptsExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    ShouldAutoSize
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
            $receipt->receipt_number ?? $receipt->id,
            $receipt->name,
            $receipt->mobile ?? '-',
            $receipt->city?->name ?? '-',
            $receipt->address ?? '-',
            $receipt->date
                ? $receipt->date->format('d-m-Y')
                : '-',
        ];

        $total = 0;

        /*
        |--------------------------------------------------------------------------
        | Category Amounts
        |--------------------------------------------------------------------------
        */

        foreach ($this->categories as $category) {

            $detail = $receipt->receiptDetails
                ->firstWhere('category_id', $category->id);

            $amount = $detail
                ? (float) $detail->amount
                : 0;

            $row[] = $amount;

            $total += $amount;
        }

        /*
        |--------------------------------------------------------------------------
        | Total
        |--------------------------------------------------------------------------
        */

        $row[] = $total;

        return $row;
    }
}
