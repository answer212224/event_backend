<?php

namespace App\Http\Controllers\Backend;

use App\Exports\MothersDayExport;
use App\Http\Controllers\Controller;
use App\Models\ChristmasMember;
use App\Models\MothersDay;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;

class ChristmasController extends Controller
{
    public function index()
    {
        $members = MothersDay::latest()->paginate(12);

        return view('christmas', compact('members'));
    }

    public function export()
    {
        return (new MothersDayExport)->download('mothersday' . now() . '.xlsx');
    }

    public function destroy($member)
    {
        MothersDay::destroy($member);
        Sweetalert::success("#$member has been deleted.", 'Deleted!');
        return back();
    }
}
