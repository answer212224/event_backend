<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeywordController extends Controller
{

    public function store(Request $request)
    {

        $activity = Activity::where('name', 'keywords')->first();

        if (now() < $activity->start_at) {
            $data = [
                'state' => false,
                'message' => [
                    '投票尚未開始，敬請期待'
                ]
            ];

            return response()->json($data);
        }

        if (now() > $activity->end_at) {
            $data = [
                'state' => false,
                'message' => [
                    '投票已結束，敬請期待抽獎結果'
                ]
            ];

            return response()->json($data);
        }


        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'vote_id' => 'required|numeric',
            'token' => 'recaptcha',
        ]);

        if ($validator->fails()) {

            $data = [
                'state' => false,
                'message' => $validator->errors()->all()
            ];

            return response()->json($data);
        }

        $keywordByPhoneOrEamilAndToday = Keyword::where('date_only', today()->format('Y-m-d'))
            ->where(function ($query) use ($request) {
                $query->where('phone', $request->phone)
                    ->orWhere('email', $request->email);
            })->first();

        if ($keywordByPhoneOrEamilAndToday) {
            $data = [
                'state' => false,
                'message' => [
                    '此MAIL或手機號碼今日已投過'
                ]
            ];

            return response()->json($data);
        }

        Keyword::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'vote_id' => $request->vote_id,
            'date_only' => today()->format('Y-m-d'),
            'ip' => getIp(),
        ]);

        $data = [
            'state' => true,
            'message' => 'ok'
        ];

        return response()->json($data);
    }
}
