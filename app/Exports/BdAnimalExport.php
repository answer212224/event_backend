<?php

namespace App\Exports;

use App\Models\BdAnimalMember;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BdAnimalExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return BdAnimalMember::withCount('votes')->orderBy('votes_count', 'desc');
    }
    public function headings(): array
    {
        return [
            '#', 'udn', 'email', 'created_at', 'updated_at', 'votes_count'
        ];
    }
}
