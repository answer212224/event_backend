<?php

namespace App\Http\Controllers\Backend;

use App\Models\NewsPrize;
use App\Charts\SampleChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsVote;

class NewsVoteController extends Controller
{
    public function index()
    {
        $chart = new SampleChart;
        $chartNews = new SampleChart;

        $members = NewsVote::get();
        $year = today()->year;

        $members = $members->groupBy(function ($val) {
            return $val->created_at->format('Y');
        });

        $multiplied = $members->map(function ($item, $key) {
            return $item->count();
        });

        $multiplied = $multiplied->sortKeys();

        if (!empty($members[$year])) {
            $members2022 = $members[$year]->countBy('vote_id')->sortKeys();

            $chart->labels($multiplied->keys());
            $chart->dataset('參與人數', 'line', $multiplied->values())->color('rgb(75, 192, 192)')->backgroundColor('rgba(75, 192, 192, 0.2)');

            $chartNews->labels($members2022->keys());
            $chartNews->dataset("$year 年 大事件 ID", 'bar', $members2022->values())->color('rgba(255, 205, 86)')->backgroundColor('rgba(255, 205, 86, 0.2)');

            return view('news.index', compact('chart', 'chartNews'));
        }

        return view('news.index');
    }

    public function members()
    {
        return view('news.member');
    }

    public function prizes()
    {
        return view('news.prize');
    }

    public function lottery()
    {

        return view('news.lottery');
    }

    public function result()
    {

        $bigNewsWinners = session('bigNewsWinners');
        $participateWinners = session('participateWinners');
        $prizesGbCate = session('prizesGbCate');

        if ($bigNewsWinners->count()  <= 0) {
            return back();
        }
        $year = $bigNewsWinners->first()->created_at->format('Y');

        $bigNewsWinners = $prizesGbCate['大事件獎']->map(function ($item) use ($bigNewsWinners) {
            return $bigNewsWinners->shift($item->amount);
        });

        $participateWinners = $prizesGbCate['參加獎']->map(function ($item) use ($participateWinners) {
            return $participateWinners->shift($item->amount);
        });

        return view('news.result', compact('prizesGbCate', 'bigNewsWinners', 'participateWinners'));
    }


    public function delete(NewsPrize $prize)
    {
        $prize->delete();
        return back();
    }
}
