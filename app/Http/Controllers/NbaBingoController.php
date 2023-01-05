<?php

namespace App\Http\Controllers;

use App\Models\NbaBingoMember;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class NbaBingoController extends Controller
{
    protected $start = '2022-05-16 10:00';
    // protected $start = '2022-04-07 10:00';
    protected $end = '2022-05-31 23:59';

    public function index()
    {

        $member = auth('nba_bingo')->user();
        if (!$member) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }


        return response()->json([
            'bingo' => $member->selections,
            'line' => $member->line,
            'score' => $member->score,
            'state' => true
        ]);
    }

    public function state()
    {
        if (now() < $this->start) return response()->json([
            'state' => false,
            'error' => "活動於 {$this->start} 開始"
        ]);


        if (now() > $this->end) return response()->json([
            'state' => false,
            'error' => "活動已於 {$this->end} 結束"
        ]);

        return response(
            [
                'state' => true,
                'message' => 'on time!'
            ]
        );
    }


    public function store(Request $request)
    {

        if (now() < $this->start) return response()->json([
            'state' => false,
            'error' => "活動於 {$this->start} 開始"
        ]);


        if (now() > $this->end) return response()->json([
            'state' => false,
            'error' => "活動已於 {$this->end} 結束"
        ]);

        $member = auth('nba_bingo')->user();

        if (!$member) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'bingo' => 'array|size:16',
            // 'recaptcha' => 'recaptcha'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all()
            ]);
        };


        if ($member->selections->isNotEmpty()) {
            return response()->json([
                'state' => false,
                'error' => "{$member->email} 在 {$member->selections[0]->created_at} 已經選取過"
            ]);
        }

        $member->selections()->createMany([
            ['nba_bingo_question_id' => $request->bingo[0], 'index' => 0],
            ['nba_bingo_question_id' => $request->bingo[1], 'index' => 1],
            ['nba_bingo_question_id' => $request->bingo[2], 'index' => 2],
            ['nba_bingo_question_id' => $request->bingo[3], 'index' => 3],
            ['nba_bingo_question_id' => $request->bingo[4], 'index' => 4],
            ['nba_bingo_question_id' => $request->bingo[5], 'index' => 5],
            ['nba_bingo_question_id' => $request->bingo[6], 'index' => 6],
            ['nba_bingo_question_id' => $request->bingo[7], 'index' => 7],
            ['nba_bingo_question_id' => $request->bingo[8], 'index' => 8],
            ['nba_bingo_question_id' => $request->bingo[9], 'index' => 9],
            ['nba_bingo_question_id' => $request->bingo[10], 'index' => 10],
            ['nba_bingo_question_id' => $request->bingo[11], 'index' => 11],
            ['nba_bingo_question_id' => $request->bingo[12], 'index' => 12],
            ['nba_bingo_question_id' => $request->bingo[13], 'index' => 13],
            ['nba_bingo_question_id' => $request->bingo[14], 'index' => 14],
            ['nba_bingo_question_id' => $request->bingo[15], 'index' => 15],
        ]);

        return response()->json([
            'state' => true,
            'message' => '成功票選'
        ]);
    }

    public function testip()
    {
        return getIp();
    }

    public function login(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'phone' => 'required|regex:/^09[0-9]{8}$/',
                'email' => 'required|email',
                'agree' => 'required|boolean'
            ],
            [
                'name.required' => '姓名為必填'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all()
            ]);
        }
        $member = NbaBingoMember::where('email', $request->email)->orWhere('phone', $request->phone)->first();

        if ($member) {
            if (!($member->phone == $request->phone)) {
                return response()->json([
                    'state' => false,
                    'error' => '📢請輸入相對應的電話號碼'
                ]);
            }

            if (!($member->email == $request->email)) {
                return response()->json([
                    'state' => false,
                    'error' => '📢請輸入相對應的信箱'
                ]);
            }
        }

        $member = NbaBingoMember::firstOrCreate(
            [
                'phone' => $request->phone,
                'email' => $request->email,
            ],
            [
                'name' => $request->name,
                'is_agree' => $request->agree
            ]
        );

        $jwt = auth('nba_bingo')->setTTL(129600)->login($member);

        return response()->json([
            'state' => true,
            'jwt' => $jwt
        ]);
    }
}
