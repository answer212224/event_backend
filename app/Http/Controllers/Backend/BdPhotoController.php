<?php

namespace App\Http\Controllers\Backend;

use App\Exports\BdPhotoExport;
use App\Http\Controllers\Controller;
use App\Models\BdPhotoMember;
use App\Models\BdPhoto;
use Illuminate\Http\Request;

class BdPhotoController extends Controller
{
    public function index(Request $request)
    {
        $memberQuery = BdPhotoMember::query();

        if ($request->hasVoted) {
            $members = $memberQuery->withCount('votes')->having('votes_count', '>=', 1)->orderBy($request->get('order_by', 'votes_count'), 'desc')->paginate(12)->appends($request->query());
        } else {
            $members = $memberQuery->withCount('votes')->orderBy($request->get('order_by', 'votes_count'), 'desc')->paginate(12)->appends($request->query());
        }

        return view('photos/bd-photos-members', compact('members'));
    }

    public function posts(Request $request)
    {
        $petQuery = BdPhoto::query();

        $petQuery->where('name', 'like', "%{$request->name}%")->withCount('votes')->latest('votes_count')->latest();

        $pets = $petQuery->with('member')->withCount('votes')->latest('votes_count')->latest()->paginate(12)->appends($request->query());

        return view('photos/bd-photos-posts', compact('pets'));
    }

    public function show(BdPhotoMember $member)
    {
        $pets = $member->pets()->withCount('votes')->paginate();

        return view('photos/bd-photos-posts', compact('pets'));
    }

    public function votes(BdPhotoMember $member)
    {
        $votes = $member->votes()->paginate();
        return view('photos/bd-photos-votes', compact('votes'));
    }

    public function export()
    {
        return (new BdPhotoExport)->download('photos' . now() . '.csv');
    }
}
