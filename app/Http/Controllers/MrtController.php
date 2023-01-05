<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\MrtMember;
use App\Models\MrtRecord;
use Illuminate\Http\Request;
use App\Models\BdAnimalMember;
use App\Models\MrtClick;
use Wavey\Sweetalert\Sweetalert;
use Illuminate\Support\Facades\Validator;

class MrtController extends Controller
{
    public function store(Request $request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', '2022-07-01')->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', '2022-10-31')->endOfDay();

        if ($request->header('referer') != 'https://lab-event.udn.com/') {
            // if (now() < $startDate) {
            //     return response()->json([
            //         'state' => false,
            //         'error' => '活動尚未開始!'
            //     ]);
            // }
            if (now() > $endDate) {
                return response()->json([
                    'state' => false,
                    'error' => '活動已經結束!'
                ]);
            }
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'gender' => ['regex:/^(?:male|female|other)$/'],
                'phone' => 'required|regex:/^09[0-9]{8}$/',
                'outer_code' => ['regex:/^(\d{10}|\d{16})$/'],
            ]

        );

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all()
            ]);
        };

        $memberHasPhone = MrtMember::where('phone', $request->phone)->first();
        $memberHasCode = MrtMember::where('outer_code', $request->outer_code)->first();

        if ($memberHasPhone) {
            return response()->json([
                'state' => false,
                'error' => '📢此連絡電話已輸入過!'
            ]);
        }

        if ($memberHasCode) {
            return response()->json([
                'state' => false,
                'error' => '📢此悠遊卡號已輸入過!'
            ]);
        }

        MrtMember::create(
            [
                'name' => $request->name,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'outer_code' => $request->outer_code,
                'ip' => getIp(),
                'transportation' => $request->transportation,
                'is_covid' => $request->is_covid,
                'is_lottery' => $request->is_lottery,
            ],
        );

        return response()->json([
            'state' => true,
            'message' => '登錄完成，祝您中獎！'
        ]);
    }
    public function click()
    {
        MrtClick::create([
            'ip' => getIp()
        ]);
        return response()->json([
            'state' => true,
            'message' => '台北通點擊'
        ]);
    }
}
