<?php

namespace App\Http\Controllers\Backend;


use Carbon\Carbon;
use App\Models\Keyword;
use App\Charts\SampleChart;
use App\Models\KeywordPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeywordController extends Controller
{
    public function index()
    {
        $chart = new SampleChart;
        $chartWord = new SampleChart;

        $members = Keyword::get();
        $year = today()->year;

        $members = $members->groupBy(function ($val) {
            return $val->created_at->format('Y');
        });

        $multiplied = $members->map(function ($item, $key) {
            return $item->count();
        });

        $multiplied = $multiplied->sortKeys();

        $members = $members[$year]->countBy('vote_id')->sortKeys();

        $chart->labels($multiplied->keys());
        $chart->dataset('參與人數', 'line', $multiplied->values())->color('rgb(75, 192, 192)')->backgroundColor('rgba(75, 192, 192, 0.2)');


        $chartWord->labels($members->keys());
        $chartWord->dataset("$year 年關鍵字 ID", 'bar', $members->values())->color('rgba(255, 205, 86)')->backgroundColor('rgba(255, 205, 86, 0.2)');


        return view('keywords.index', compact('chart', 'chartWord'));
    }

    public function members()
    {
        return view('keywords.member');
    }

    public function lottery()
    {

        return view('keywords.lottery');
    }

    public function prizes()
    {
        return view('keywords.prize');
    }

    public function result()
    {
        $predictionWinners = session('predictionWinners');
        $participateWinners = session('participateWinners');
        $prizesGbCate = session('prizesGbCate');

        if ($predictionWinners->count()  <= 0) {
            return back();
        }
        $year = $predictionWinners->first()->created_at->format('Y');

        $predictionWinners = $prizesGbCate['預測王']->map(function ($item) use ($predictionWinners) {
            return $predictionWinners->shift($item->amount);
        });

        $participateWinners = $prizesGbCate['參加獎']->map(function ($item) use ($participateWinners) {
            return $participateWinners->shift($item->amount);
        });

        return view('keywords.result', compact('predictionWinners', 'participateWinners', 'prizesGbCate'));
    }

    public function delete(KeywordPrize $prize)
    {
        $prize->delete();
        return back();
    }
}
