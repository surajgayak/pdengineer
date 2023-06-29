<?php

namespace App\Exports;

use App\Models\StockManagement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportStockManagement implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return StockManagement::select(['entry_date', 'product_id', 'item', 'purchase_price', 'selling_price', 'quantity', 'unit'])->get();
    }
    public function headings(): array
    {
        return [
            'Entry Date',
            'Product',
            'Item',
            'Purchase Date',
            'Selling Price',
            'Quantity',
            'Unit'
        ];
    }
    public function map($row): array
    {

        return [
            $row->entry_date,
            $row->product->title,
            $row->item,
            $row->purchase_price,
            $row->selling_price,
            $row->quantity,
            $row->unit,
        ];
    }
}
