<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class LotteryController extends Controller
{
    public function index()
    {

        return view('lottery');
    }

    public function result(Request $request)
    {

        $gcpHasTable = Schema::hasTable($request->table);
        $eventHasTable = Schema::connection('event')->hasTable($request->table);
        if ($gcpHasTable) {
            $members = collect(DB::connection('mysql')->select("select * from $request->table"));
        } else if ($eventHasTable) {
            $members = collect(DB::connection('event')->select("select * from $request->table"));
        } else {
            Sweetalert::warning("請確認 $request->table 資料表是否存在");
            return back()->withInput();
        }

        $data['columns'] = collect($members->first())->keys()->all();
        $poolIds = $members->pluck($data['columns'][0]);
        $lotteryIds = collect([]);

        try {
            for ($i = 0; $i < 10; $i++) {


                $data['lotterys'][$i] = [
                    'input' => [
                        'award' => $request->awards[$i] ?? null,
                        'prize' => $request->prizes[$i] ?? null,
                        'count' => $request->counts[$i] ?? 0
                    ]
                ];

                $lotteryIds = $poolIds->random($data["lotterys"][$i]['input']["count"]);

                $poolIds = $poolIds->diff($lotteryIds);

                $lotteryMembers = $members->whereIn($data['columns'][0], $lotteryIds)->values();

                if ($lotteryMembers->pluck($data['columns'][1])->duplicates()->isNotEmpty()) {
                    Sweetalert::warning("{$data['lotterys'][$i]['input']['award']} 的 {$data['columns'][1]} 有重複結果，請重抽!");
                };

                $data["lotterys"][$i]["lotteryMembers"] = $lotteryMembers;
            }
        } catch (\InvalidArgumentException $e) {
            Sweetalert::warning("請確認會員數是否足夠!");
            return back()->withInput();
        }


        session()->flash('data', $data);
        return view('lottery-result', compact('data'));
    }


    public function export()
    {
        $data = session('data');

        $columns = collect($data['columns']);

        $lotterys = collect($data['lotterys']);

        $filtered = $lotterys->reject(function ($value, $key) {
            return count($value['lotteryMembers']) == 0;
        });

        // dd($filtered);

        $all = collect([]);

        foreach ($filtered as $item) {

            $all->add([
                $item['input']['award'],
                $item['input']['prize'],
                $item['input']['count']
            ]);
            $all = $all
                ->merge($item['lotteryMembers']);
        }
        // dd($all);

        return ($all)->downloadExcel(
            'lottery' . now() . '.xls',
            $writerType = null,
            $headings = false
        );
        // return (new LotteryExport)->download('lottery' . now() . '.xls');
    }
}
