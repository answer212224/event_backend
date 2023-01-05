<?php

namespace App\Http\Controllers\Backend;

use App\Exports\nbaBingoMemberExport;
use App\Http\Controllers\Controller;
use App\Models\NbaBingoMember;
use App\Models\NbaBingoMemberSelection;
use App\Models\NbaBingoQuestion;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

class NbaBingoController extends Controller
{

    public function index(Request $request)
    {
        $memberQuery = NbaBingoMember::query();

        $members = $memberQuery->orderBy($request->get('order_by', 'id'), 'desc')->paginate(12)->appends($request->query());

        return view('nbabingo', compact('members'));
    }

    public function show(NbaBingoMember $member)
    {
        $selections = $member->selections()->with('nbaBingoQuestion')->get();

        return view('nbabingo-show', compact('selections'));
    }

    public function update()
    {
        $correctQuestions = NbaBingoQuestion::where('is_correct', true)->get();
        //init
        NbaBingoMemberSelection::query()->update(['is_win' => 0]);
        $correctSelections = NbaBingoMemberSelection::whereIn('nba_bingo_question_id', $correctQuestions->pluck('id'));
        $correctSelections->update(['is_win' => 1]);

        $members = NbaBingoMember::withCount([
            'selections as hits' => function (Builder $query) {
                $query->where('is_win', 1);
            },
            'selections as line1' => function (Builder $query) {
                $query->whereIn('index', [0, 1, 2, 3])->where('is_win', 1);
            },
            'selections as line2' => function (Builder $query) {
                $query->whereIn('index', [4, 5, 6, 7])->where('is_win', 1);
            },
            'selections as line3' => function (Builder $query) {
                $query->whereIn('index', [8, 9, 10, 11])->where('is_win', 1);
            },
            'selections as line4' => function (Builder $query) {
                $query->whereIn('index', [12, 13, 14, 15])->where('is_win', 1);
            },
            'selections as line5' => function (Builder $query) {
                $query->whereIn('index', [0, 4, 8, 12])->where('is_win', 1);
            },
            'selections as line6' => function (Builder $query) {
                $query->whereIn('index', [1, 5, 9, 13])->where('is_win', 1);
            },
            'selections as line7' => function (Builder $query) {
                $query->whereIn('index', [2, 6, 10, 14])->where('is_win', 1);
            },
            'selections as line8' => function (Builder $query) {
                $query->whereIn('index', [3, 7, 11, 15])->where('is_win', 1);
            },
            'selections as line9' => function (Builder $query) {
                $query->whereIn('index', [0, 5, 10, 15])->where('is_win', 1);
            },
            'selections as line10' => function (Builder $query) {
                $query->whereIn('index', [3, 6, 9, 12])->where('is_win', 1);
            },

        ])->get();


        $members->each(function ($member) {
            $line = 0;
            if ($member->line1 >= 4) {
                $line += 1;
            }
            if ($member->line2 >= 4) {
                $line += 1;
            }
            if ($member->line3 >= 4) {
                $line += 1;
            }
            if ($member->line4 >= 4) {
                $line += 1;
            }
            if ($member->line5 >= 4) {
                $line += 1;
            }
            if ($member->line6 >= 4) {
                $line += 1;
            }
            if ($member->line7 >= 4) {
                $line += 1;
            }
            if ($member->line8 >= 4) {
                $line += 1;
            }
            if ($member->line9 >= 4) {
                $line += 1;
            }
            if ($member->line10 >= 4) {
                $line += 1;
            }
            $member->update([
                'score' => $member->hits,
                'line' => $line,
            ]);
        });

        Session::flash('success', 'members selections has been updated');
        return back();
    }

    public function export()
    {
        return (new nbaBingoMemberExport)->download('nba_bingo_member' . now() . '.xlsx');
    }
}
