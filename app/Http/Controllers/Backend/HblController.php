<?php

namespace App\Http\Controllers\Backend;

use App\Exports\HblMembersExport;
use App\Http\Controllers\Controller;
use App\Models\HblMember;
use App\Models\HblTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class HblController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $memberQuery = HblMember::query();

        if ($request->isApp == 'on') {
            $memberQuery->where('is_app', true);
        }

        if (isset($request->date)) {
            $memberQuery->whereHas('predictions',  function ($query) use ($request) {
                $query->whereDate('created_at', $request->date)->where('is_win', true);
            }, '>=', 8);
        }

        $members = $memberQuery->paginate(12)->appends($request->query());

        return view('hbl', compact('members'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HblMember $member)
    {
        $predictions = $member->predictions()->with('team')->latest()->paginate(8);
        return view('hbl-predictions', compact('predictions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $winnerTeams = HblTeam::with('predictions')->where('is_winner', true);
        $winnerTeams->each(function ($winnerTeam) {
            $winnerTeam->predictions()->update([
                'is_win' => true
            ]);
        });
        Session::flash('success', 'members predictions has been updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export()
    {
        return Excel::download(new HblMembersExport, 'users.xlsx');
    }
}
