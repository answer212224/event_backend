<?php

namespace App\Exports;

use App\Models\MrtMember;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class MrtMemberExport implements FromQuery, WithHeadings

{
    use Exportable;
    // id, name, gender, phone, outer_code, created_at, updated_at, transportation, is_covid, is_lottery, ip
    public function query()
    {
        return MrtMember::query()->select(['id', 'name', 'gender', 'phone', 'outer_code', 'transportation', 'is_covid', 'is_lottery', 'ip', 'created_at']);
    }
    public function headings(): array
    {
        return [
            '編號', '姓名', '性別', '聯絡電話', '卡號', '交通工具', '因疫情', '為了抽獎', 'ip', '建立時間'
        ];
    }
}
