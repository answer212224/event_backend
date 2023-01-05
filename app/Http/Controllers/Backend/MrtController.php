<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\MrtMember;
use App\Models\MrtRecord;
use Illuminate\Http\Request;
use App\Exports\MrtMemberExport;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;
use App\Models\MrtClick;
use App\Models\MrtEveryMonthRecord;
use App\Models\MrtMonthRecord;
use App\Models\MrtWinner;
use Illuminate\Database\Eloquent\Builder;

class MrtController extends Controller
{
    public function index()
    {

        return view('mrt.index');
    }

    public function members(Request $request)
    {
        $memberQuery = MrtMember::query();
        $count = MrtClick::count();
        if ($request->outer_code) {
            $members = $memberQuery->where('outer_code', $request->outer_code)->orderBy(('created_at'), 'desc')->paginate(12)->appends($request->query());
            return view('mrt.members', compact('members', 'count'));
        }
        $members = $memberQuery->orderBy(('created_at'), 'desc')->paginate(12)->appends($request->query());
        return view('mrt.members', compact('members', 'count'));
    }

    public function records(Request $request)
    {
        $memberQuery = MrtRecord::query();
        if ($request->outer_code) {
            $members = $memberQuery->where('outer_code', $request->outer_code)->orderBy(('recorded_at'), 'desc')->paginate(12)->appends($request->query());
            return view('mrt.records', compact('members'));
        }
        $members = $memberQuery->orderBy(('recorded_at'), 'desc')->paginate(12)->appends($request->query());
        return view('mrt.records', compact('members'));
    }

    public function winners()
    {
        return view('mrt.winners');
    }

    public function weekStore()
    {
        $mrtWinners = session()->get('mrtWinners');
        $week = session()->get('week');

        MrtWinner::upsert([
            ['award' => "$week,頭獎1", 'mrt_member_id' => $mrtWinners[0]->member->id],
            ['award' => "$week,貳獎1", 'mrt_member_id' => $mrtWinners[1]->member->id],
            ['award' => "$week,貳獎2", 'mrt_member_id' => $mrtWinners[2]->member->id],
            ['award' => "$week,參獎1", 'mrt_member_id' => $mrtWinners[3]->member->id],
            ['award' => "$week,參獎2", 'mrt_member_id' => $mrtWinners[4]->member->id],
            ['award' => "$week,參獎3", 'mrt_member_id' => $mrtWinners[5]->member->id],
            ['award' => "$week,肆獎1", 'mrt_member_id' => $mrtWinners[6]->member->id],
            ['award' => "$week,肆獎2", 'mrt_member_id' => $mrtWinners[7]->member->id],
            ['award' => "$week,肆獎3", 'mrt_member_id' => $mrtWinners[8]->member->id],
            ['award' => "$week,肆獎4", 'mrt_member_id' => $mrtWinners[9]->member->id],
            ['award' => "$week,肆獎5", 'mrt_member_id' => $mrtWinners[10]->member->id],
            ['award' => "$week,肆獎6", 'mrt_member_id' => $mrtWinners[11]->member->id],
            ['award' => "$week,肆獎7", 'mrt_member_id' => $mrtWinners[12]->member->id],
            ['award' => "$week,肆獎8", 'mrt_member_id' => $mrtWinners[13]->member->id],
            ['award' => "$week,肆獎9", 'mrt_member_id' => $mrtWinners[14]->member->id],
            ['award' => "$week,肆獎10", 'mrt_member_id' => $mrtWinners[15]->member->id],
            ['award' => "$week,肆獎11", 'mrt_member_id' => $mrtWinners[16]->member->id],
            ['award' => "$week,肆獎12", 'mrt_member_id' => $mrtWinners[17]->member->id],
            ['award' => "$week,肆獎13", 'mrt_member_id' => $mrtWinners[18]->member->id],
            ['award' => "$week,肆獎14", 'mrt_member_id' => $mrtWinners[19]->member->id],
            ['award' => "$week,肆獎15", 'mrt_member_id' => $mrtWinners[20]->member->id],
            ['award' => "$week,肆獎16", 'mrt_member_id' => $mrtWinners[21]->member->id],
            ['award' => "$week,肆獎17", 'mrt_member_id' => $mrtWinners[22]->member->id],
            ['award' => "$week,肆獎18", 'mrt_member_id' => $mrtWinners[23]->member->id],
            ['award' => "$week,肆獎19", 'mrt_member_id' => $mrtWinners[24]->member->id],
            ['award' => "$week,肆獎20", 'mrt_member_id' => $mrtWinners[25]->member->id],
            ['award' => "$week,普獎1", 'mrt_member_id' => $mrtWinners[26]->member->id],
            ['award' => "$week,普獎2", 'mrt_member_id' => $mrtWinners[27]->member->id],
            ['award' => "$week,普獎3", 'mrt_member_id' => $mrtWinners[28]->member->id],
            ['award' => "$week,普獎4", 'mrt_member_id' => $mrtWinners[29]->member->id],
            ['award' => "$week,普獎5", 'mrt_member_id' => $mrtWinners[30]->member->id],
            ['award' => "$week,普獎6", 'mrt_member_id' => $mrtWinners[31]->member->id],
            ['award' => "$week,普獎7", 'mrt_member_id' => $mrtWinners[32]->member->id],
            ['award' => "$week,普獎8", 'mrt_member_id' => $mrtWinners[33]->member->id],
            ['award' => "$week,普獎9", 'mrt_member_id' => $mrtWinners[34]->member->id],
            ['award' => "$week,普獎10", 'mrt_member_id' => $mrtWinners[35]->member->id],
            ['award' => "$week,普獎11", 'mrt_member_id' => $mrtWinners[36]->member->id],
            ['award' => "$week,普獎12", 'mrt_member_id' => $mrtWinners[37]->member->id],
            ['award' => "$week,普獎13", 'mrt_member_id' => $mrtWinners[38]->member->id],
            ['award' => "$week,普獎14", 'mrt_member_id' => $mrtWinners[39]->member->id],
            ['award' => "$week,普獎15", 'mrt_member_id' => $mrtWinners[40]->member->id],
            ['award' => "$week,普獎16", 'mrt_member_id' => $mrtWinners[41]->member->id],
            ['award' => "$week,普獎17", 'mrt_member_id' => $mrtWinners[42]->member->id],
            ['award' => "$week,普獎18", 'mrt_member_id' => $mrtWinners[43]->member->id],
            ['award' => "$week,普獎19", 'mrt_member_id' => $mrtWinners[44]->member->id],
            ['award' => "$week,普獎20", 'mrt_member_id' => $mrtWinners[45]->member->id],
        ], ['award'], ['mrt_member_id']);

        return redirect()->route('mrt.winners');
    }

    public function week(Request $request)
    {
        $days = explode(',', session('week'));
        $startDate = Carbon::createFromFormat('Y-m-d', $days[0])->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $days[1])->endOfDay();

        $mrtRecords = MrtRecord::whereBetween('recorded_at', [$startDate, $endDate]);

        $mrtRecords = $mrtRecords->get();

        $notNormalTypeRcords = $mrtRecords->where('type', '!=', '一般');
        $mrtRecords = $mrtRecords->concat($notNormalTypeRcords);

        $mrtWinners = $mrtRecords->random(46);

        while (!$mrtWinners->pluck('outer_code')->duplicates()->isEmpty()) {
            $mrtWinners = $mrtRecords->random(46);
        }


        session()->put('mrtWinners', $mrtWinners);

        return view('mrt.week', compact('mrtWinners'));
    }

    public function monthStore(Request $request)
    {
        $mrtWinner = session()->get('mrtWinner');
        $month = session()->get('month');
        switch ($month) {
            case 7:
                $award = '2022-07-29,2022-08-04,特獎';
                break;
            case 8:
                $award = '2022-08-26,2022-09-01,特獎';
                break;
            case 9:
                $award = '2022-09-30,2022-10-06,特獎';
                break;
            case 10:
                $award = '2022-10-28,2022-10-31,特獎';
                break;
            default:
                # code...
                break;
        }

        MrtWinner::firstOrCreate(
            ['award' => $award],
            ['mrt_member_id' => $mrtWinner->member->id]
        );

        return redirect()->route('mrt.winners');
    }

    public function everyMonthStore(Request $request)
    {
        $mrtWinner = session()->get('mrtWinner');


        MrtWinner::firstOrCreate(
            ['award' => '2022-10-28,2022-10-31,全勤獎'],
            ['mrt_member_id' => $mrtWinner->member->id]
        );

        return redirect()->route('mrt.winners');
    }

    public function month(Request $request)
    {
        $mrtWinner = MrtMonthRecord::where('month', session('month'))->get()->random();
        session()->put('mrtWinner', $mrtWinner);
        return view('mrt.month', compact('mrtWinner'));
    }

    public function everyMonth()
    {
        $mrtWinner = MrtEveryMonthRecord::get()->random();
        session()->put('mrtWinner', $mrtWinner);
        return view('mrt.every-month', compact('mrtWinner'));
    }

    public function memberExport()
    {
        return (new MrtMemberExport)->download('mrt_members' . now() . '.xlsx');
    }
}
