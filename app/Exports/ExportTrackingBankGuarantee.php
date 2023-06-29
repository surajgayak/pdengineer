<?php

namespace App\Exports;

use App\Enums\TrackingType;
use App\Models\TrackingBankGuarantee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportTrackingBankGuarantee implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TrackingBankGuarantee::select(['type', 'start_date', 'project_name', 'client_name', 'expiry_date', 'bank_amount', 'bank_name', 'status'])->get();
    }
    public function headings(): array
    {
        return [
            'Type',
            'Start Date',
            'Project Name',
            'Client Name',
            'Bank Amount',
            'Bank Name',
            'Expiry Date',
            'Status'
        ];
    }
    public function map($row): array
    {
        $type = match ($row->type) {
            0 => $row->type = 'BB',
            1 => $row->type = 'PB',
            2 => $row->type = 'Retention',
            3 => $row->type = 'Custom Margin',
        };
        $status = match ($row->status) {
            0 => 'EXPIRED TO BE REFUNDED',
            1 => 'Refunded',
            2 => 'Active'
        };

        return [
            $type,
            $row->start_date,
            $row->project_name,
            $row->client_name,
            $row->bank_amount,
            $row->bank_name,
            $row->expiry_date,
            $status
        ];
    }
}
