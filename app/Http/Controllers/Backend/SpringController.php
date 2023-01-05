<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Spring;
use Illuminate\Http\Request;
use App\Exports\SpringExport;


class SpringController extends Controller
{

    public function index(Request $request)
    {
        $query = Spring::query();

        if ($request->isPrize == 'on') {
            $query->where('prize', 1);
        }

        $members = $query->paginate(12)->appends($request->query());

        return view('spring', compact('members'));
    }

    public function export()
    {
        return (new SpringExport)->download('spring' . now() . '.xlsx');
    }

    public function destroy(Spring $spring)
    {
        $spring->delete();
        return back();
    }
}
