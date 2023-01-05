<?php

namespace App\Exports;

use App\Models\HblMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HblMembersExport implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            '#',
            'User',
            'email',
            'isApp'
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return HblMember::all();
    }
}
