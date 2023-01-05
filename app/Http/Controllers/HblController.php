<?php

namespace App\Http\Controllers;

use App\Models\HblMember;
use App\Models\HblTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HblController extends Controller
{
    protected $start = '2022-01-03 12:00:00';
    protected $end = '2022-02-20 12:00:00';

    public function index()
    {
        $status = true;

        if (now() < $this->start) {
            $status = false;
            $error = "活動於 {$this->start} 開始，敬請期待";
        }
        if (now() > $this->end) {
            $status = false;
            $error = "活動於 {$this->end} 結束，敬請期待結果";
        }

        $hblTeams = HblTeam::withCount('predictions')->get()->groupBy('group');

        $member = auth('hbl')->user();

        if ($member) {
            $ids = $member->predictions()->whereDate('created_at', today())->get()->pluck('hbl_team_id');
            $hblTeams->prepend($ids, 'member_data');
        } else {
            $ids = null;
            $hblTeams->prepend($ids, 'member_data');
        }

        if ($status) {
            $hblTeams->prepend($status, 'status');
        } else {
            $hblTeams->prepend($error, 'error');
            $hblTeams->prepend($status, 'status');
        }


        return response()->json($hblTeams);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'udnmember' => 'required',
            'um2' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all()
            ]);
        }

        $response = getUdnMember($request->udnmember, $request->um2);
        // $response = getUdnMember($request->udnmember, urlencode($request->um2));

        if (!$response || $response['response']['status'] != 'success') {
            return response()->json([
                'state' => false,
                'error' => '不是udn會員'
            ]);
        }

        $member = HblMember::firstOrCreate(
            [
                'udn' => $request->udnmember
            ],
            [
                'email' => $response['response']['email'],
            ]
        );


        $token = auth('hbl')->setTTL(129600)->login($member);

        return response()->json([
            'state' => true,
            'token' => $token
        ]);
    }

    public function storePredictionTeam(Request $request)
    {

        if (now() < $this->start) return response()->json([
            'state' => false,
            'error' => "活動於 {$this->start} 開始，敬請期待"
        ]);


        if (now() > $this->end) return response()->json([
            'state' => false,
            'error' => "活動於 {$this->end} 結束，敬請期待結果"
        ]);


        $member = auth('hbl')->user();

        if (!$member) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'hbl_teams.male' => 'size:4',
            'hbl_teams.male.*' => [
                'required',
                'distinct',
                'numeric',
            ],
            'hbl_teams.female' => 'size:4',
            'hbl_teams.female.*' => [
                'required',
                'distinct',
                'numeric',
            ],
            'app' => 'boolean',
            'token' => 'recaptcha'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all()
            ]);
        };

        $predictions = $member->predictions()->whereDate('created_at', today())->get();
        if ($predictions->isNotEmpty()) {
            return response()->json([
                'state' => false,
                'error' => "{$member->udn} 已預測隊伍 在" . today()->format('Y年m月d日')
            ]);
        }

        if (!$member->is_app) {
            $request->app ? $member->is_app = true : $member->is_app = false;
            $member->save();
        }

        $member->predictions()->createMany([
            ['hbl_team_id' => $request['hbl_teams']['male'][0], 'is_app' => $request->app],
            ['hbl_team_id' => $request['hbl_teams']['male'][1], 'is_app' => $request->app],
            ['hbl_team_id' => $request['hbl_teams']['male'][2], 'is_app' => $request->app],
            ['hbl_team_id' => $request['hbl_teams']['male'][3], 'is_app' => $request->app],
            ['hbl_team_id' => $request['hbl_teams']['female'][0], 'is_app' => $request->app],
            ['hbl_team_id' => $request['hbl_teams']['female'][1], 'is_app' => $request->app],
            ['hbl_team_id' => $request['hbl_teams']['female'][2], 'is_app' => $request->app],
            ['hbl_team_id' => $request['hbl_teams']['female'][3], 'is_app' => $request->app],
        ]);



        return response()->json([
            'state' => true,
            'message' => '成功票選'
        ]);
    }
}
