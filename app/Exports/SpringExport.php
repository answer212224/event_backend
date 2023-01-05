<?php

namespace App\Exports;

use App\Models\Spring;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class springExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Spring::query();
    }
    public function headings(): array
    {
        return [
            '#', 'udn', 'email', 'prize', 'created_at', 'updated_at'
        ];
    }
}
