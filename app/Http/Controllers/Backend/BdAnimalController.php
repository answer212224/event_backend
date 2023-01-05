<?php

namespace App\Http\Controllers\Backend;

use App\Exports\BdAnimalExport;
use App\Http\Controllers\Controller;
use App\Models\BdAnimalMember;
use App\Models\BdAnimalPet;
use App\Models\BdAnimalVote;
use Illuminate\Http\Request;

class BdAnimalController extends Controller
{
    public function index(Request $request)
    {
        $memberQuery = BdAnimalMember::query();

        if ($request->hasVoted) {
            $members = $memberQuery->withCount('votes')->having('votes_count', '>=', 1)->orderBy($request->get('order_by', 'votes_count'), 'desc')->paginate(12)->appends($request->query());
        } else {
            $members = $memberQuery->withCount('votes')->orderBy($request->get('order_by', 'votes_count'), 'desc')->paginate(12)->appends($request->query());
        }

        return view('bd-animal-members', compact('members'));
    }

    public function posts(Request $request)
    {
        $petQuery = BdAnimalPet::query();

        $petQuery->where('name', 'like', "%{$request->name}%")->withCount('votes')->latest('votes_count')->latest();

        $pets = $petQuery->with('member')->withCount('votes')->latest('votes_count')->latest()->paginate(12)->appends($request->query());

        return view('bd-animal-posts', compact('pets'));
    }

    public function show(BdAnimalMember $member)
    {
        $pets = $member->pets()->withCount('votes')->paginate();

        return view('bd-animal-posts', compact('pets'));
    }

    public function votes(BdAnimalMember $member)
    {
        $votes = $member->votes()->paginate();
        return view('bd-animal-votes', compact('votes'));
    }

    public function export()
    {
        return (new BdAnimalExport)->download('pets' . now() . '.csv');
    }
}
