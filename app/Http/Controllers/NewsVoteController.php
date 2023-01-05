<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\NewsVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsVoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = Activity::where('name', 'news')->first();
        if (now() < $activity->start_at) {
            $data = [
                'state' => false,
                'message' => [
                    '投票尚未開始 敬請期待!'
                ]
            ];

            return response()->json($data);
        }

        if (now() > $activity->end_at) {
            $data = [
                'state' => false,
                'message' => [
                    '投票已結束 敬請期待抽獎結果!'
                ]
            ];
            return response()->json($data);
        }


        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'vote_id' => 'required|numeric',
            'agree' => 'accepted',
            'token' => 'recaptcha',
        ]);

        if ($validator->fails()) {
            $data = [
                'state' => false,
                'message' => $validator->errors()->all()
            ];
            return response()->json($data);
        }

        $NewsVotePhone =  NewsVote::whereDate('created_at', today())->firstWhere('phone', $request->phone);

        if ($NewsVotePhone) {
            $data = [
                'state' => false,
                'message' => [
                    $request->phone . ' 今日已投過票 !'
                ]
            ];
            return response()->json($data);
        }

        NewsVote::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'vote_id' => $request->vote_id,
            'ip' => getIp(),
        ]);

        $data = [
            'state' => true,
            'message' => 'ok'
        ];

        return response()->json($data);
    }
}
