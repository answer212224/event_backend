<?php

namespace App\Exports;

use App\Models\NbaBingoMember;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class nbaBingoMemberExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return NbaBingoMember::query();
    }
    public function headings(): array
    {
        return [
            '#', 'name', 'email', 'phone', 'is_agree', 'line', 'score', 'created_at', 'updated_at'
        ];
    }
}
