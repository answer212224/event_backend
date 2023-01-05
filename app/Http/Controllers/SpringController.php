<?php

namespace App\Http\Controllers;

use App\Models\Spring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SpringController extends Controller
{
    // protected $start = '2022-03-03 00:00:00';
    protected $start = '2022-03-21 00:00:00';
    protected $end = '2022-04-07 00:00:00';

    public function index(Request $request)
    {
        // return response()->json([
        //     'state' => false,
        //     'server' => $request->server(),
        //     'header' => $request->header('referer')
        // ]);

        if (now() < $this->start) {
            return response()->json([
                'state' => false,
                'error' => "活動於 {$this->end} 結束，敬請期待結果"
            ]);
        }
        if (now() > $this->end) {
            return response()->json([
                'state' => false,
                'error' => "活動於 {$this->end} 結束，敬請期待結果"
            ]);
        }

        $member = auth('spring')->user();

        if (!$member) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$member->prize) {
            return response()->json([
                'state' => false,
                'error' => "你已選擇獎品: $member->prize"
            ]);
        }

        return response()->json([
            'state' => true,
            'message' => '很棒 ok!'
        ]);
    }

    public function login(Request $request)
    {
        if ($request->header('referer') != 'https://lab-event.udn.com/') {
            if (now() < $this->start) return response()->json([
                'state' => false,
                'error' => "活動於 {$this->start} 開始，敬請期待",
            ]);


            if (now() > $this->end) return response()->json([
                'state' => false,
                'error' => "活動於 {$this->end} 結束，敬請期待結果"
            ]);
        }

        $validator = Validator::make($request->all(), [
            'udnmember' => 'required',
            'um2' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all(),
            ]);
        }

        // $response = getUdnMember($request->udnmember, $request->um2);
        $response = getUdnMember($request->udnmember, urlencode($request->um2));

        if (!$response || $response['response']['status'] != 'success') {
            return response()->json([
                'state' => false,
                'error' => '此帳號非udn會員'
            ]);
        }

        $member = Spring::firstOrCreate(
            [
                'udn' => $request->udnmember
            ],
            [
                'email' => $response['response']['email'],
            ]
        );

        $jwt = auth('spring')->setTTL(129600)->login($member);

        return response()->json([
            'state' => true,
            'jwt' => $jwt,
            'member' => $member
        ]);
    }

    public function store(Request $request)
    {
        if ($request->header('referer') != 'https://lab-event.udn.com/') {
            if (now() < $this->start) return response()->json([
                'state' => false,
                'error' => "活動於 {$this->start} 開始，敬請期待"
            ]);


            if (now() > $this->end) return response()->json([
                'state' => false,
                'error' => "活動於 {$this->end} 結束，敬請期待結果"
            ]);
        }

        $member = auth('spring')->user();

        if (!$member) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'prize' => 'required|numeric',
            'g-recaptcha-response' => 'recaptcha'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all()
            ]);
        };

        if ($member->prize) {
            return response()->json([
                'state' => false,
                'error' => "$member->udn 在 $member->updated_at 已選取過"
            ]);
        }

        $member->prize = $request->prize;
        $member->save();

        return response()->json([
            'state' => true,
            'message' => '成功選取獎品!'
        ]);
    }
}
