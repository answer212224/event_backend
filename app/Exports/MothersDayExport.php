<?php

namespace App\Exports;

use App\Models\MothersDay;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class MothersDayExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return MothersDay::query()->select(['id', 'udn', 'email', 'award_id', 'updated_at']);
    }
    public function headings(): array
    {
        return [
            '#', 'udn', 'email', 'award', 'timestamp'
        ];
    }
}
