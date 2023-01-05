<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;


use Maatwebsite\Excel\Concerns\Exportable;

class LotteryExport implements FromCollection

{
    use Exportable;

    public function collection()
    {
        $data = session('data');
        $lotterys = collect($data['lotterys']);
        $filtered = $lotterys->reject(function ($value, $key) {
            return empty($value['lotteryMembers']);
        });



        // dd($filtered);
        return collect($filtered[0]['lotteryMembers']);
    }
}
