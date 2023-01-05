<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Activity;
use App\Charts\SampleChart;
use App\Models\ElectionVote;
use Illuminate\Http\Request;
use App\Models\ElectionClick;
use App\Models\ElectionMember;
use Wavey\Sweetalert\Sweetalert;
use App\Models\ElectionCandidate;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ElectionMembersExport;
use Illuminate\Database\Eloquent\Builder;

class ElectionController extends Controller
{
    public function index()
    {
        $clicks = ElectionClick::count();
        $users = ElectionMember::count();
        $users_app = ElectionMember::where('is_app', true)->count();
        $today_users = ElectionMember::whereDate('created_at', today())->count();
        $activity = Activity::find(1);
        $members = ElectionMember::get();
        $membersHasVotes = ElectionMember::has('votes')->get();
        $chart = new SampleChart;


        $users_played = $membersHasVotes->count();

        $members = $members->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y-m-d');
        });

        $membersHasVotes = $membersHasVotes->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y-m-d');
        });

        $multiplied = $members->map(function ($item, $key) {
            return $item->count();
        });

        $multipliedVote = $membersHasVotes->map(function ($item, $key) {
            return $item->count();
        });


        $multiplied = $multiplied->sortKeys();
        $chart->labels($multiplied->keys());
        $chart->dataset('參與人數', 'line', $multiplied->values())->color('rgb(75, 192, 192)')->backgroundColor('rgba(75, 192, 192, 0.2)');
        $chart->dataset('遊玩人數', 'line', $multipliedVote->values())->color('rgb(255, 205, 86)')->backgroundColor('rgba(255, 205, 86, 0.2)');

        return view('election.index', compact('chart', 'users', 'users_app', 'clicks', 'activity', 'users_played'));
    }
    public function members()
    {
        return view('election.members');
    }

    public function delete(ElectionMember $member)
    {
        $member->delete();

        return back();
    }

    public function candidates()
    {
        $candidates = ElectionCandidate::get();
        return view('election.candidates', compact('candidates'));
    }

    public function votes(ElectionMember $member)
    {
        return view('election.member-votes', compact('member'));
    }

    public function activity(Request $request)
    {

        $activity = Activity::find(1);
        $activity->update([
            'start_at' => $request->start,
            'end_at' => $request->end
        ]);
        Sweetalert::success("活動日期更改", '成功!');
        return back();
    }

    public function export()
    {
        return Excel::download(new ElectionMembersExport, 'users.csv');
    }

    public function update()
    {
        $candidates = ElectionCandidate::where('is_win', true)->get();
        $candidates->each(function ($candidate, $key) {
            $candidate->votes()->update([
                'is_win' => 1
            ]);
        });

        $members = ElectionMember::whereHas('votes', function (Builder $query) {
            $query->where('is_win', true);
        }, '>=', 6);
        $members->update([
            'is_win' => 1
        ]);

        Sweetalert::success("更新完成");
        return back();
    }
}
