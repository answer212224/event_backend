<?php

namespace App\Http\Controllers;

use App\Models\MothersDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChristmasController extends Controller
{
    protected $start = '2022-04-26 00:00';
    protected $end = '2022-05-09 23:59';

    public function index(Request $request)
    {
        if ($request->header('referer') != 'https://lab-event.udn.com/') {
            if (now() > $this->end) {
                $data = [
                    'state' => 3,
                    'message' => "活動於 {$this->end} 結束，敬請期待結果"
                ];

                return response()->json($data);
            }
        }
    }
    public function isAccess(Request $request)
    {
        if ($request->header('referer') != 'https://lab-event.udn.com/') {
            if (now() < $this->start) {
                $data = [
                    'state' => 3,
                    'message' => "活動於 {$this->start} 開始，敬請期待"

                ];

                return response()->json($data);
            }

            if (now() > $this->end) {
                $data = [
                    'state' => 3,
                    'message' => "活動於 {$this->end} 結束，敬請期待結果"
                ];

                return response()->json($data);
            }
        }
        $validator = Validator::make($request->all(), [
            'udnmember' => 'required',
            'um2' => 'required',
        ]);


        if ($validator->fails()) {
            $data = [
                'state' => 2,
                'error' => $validator->errors()->all()
            ];
            return response()->json($data);
        }

        $response = getUdnMember($request->udnmember, urlencode($request->um2));

        if (!$response || $response['response']['status'] != 'success') {
            return response()->json([
                'state' => false,
                'error' => '此帳號非udn會員'
            ]);
        }


        $member = MothersDay::updateOrCreate(
            [
                'udn' => $request->udnmember
            ],
            [
                'email' => $response['response']['email'],
            ]
        );

        if ($member->award != 0) {
            $data = [
                'state' => 4,
                'message' => "{$member->udn} 已在 {$member->updated_at} 選取 no.{$member->award_id} 獎項"
            ];

            return response()->json($data);
        }

        $token = auth('christmas')->login($member);

        $data = [
            'state' => 1,
            'token' => $token
        ];

        return response()->json($data);
    }

    public function storeAward(Request $request)
    {

        if ($request->header('referer') != 'https://lab-event.udn.com/') {
            if (now() < $this->start) {
                $data = [
                    'state' => false,
                    'message' => "活動於 {$this->start} 開始，敬請期待"

                ];

                return response()->json($data);
            }

            if (now() >  $this->end) {
                $data = [
                    'state' => false,
                    'message' => "活動於 {$this->end} 結束，敬請期待結果"
                ];

                return response()->json($data);
            }
        }

        $member = auth('christmas')->user();

        if (!$member) {
            $data = [
                'state' => false,
                'message' => 'access token not allowed'
            ];
            return response()->json($data, 401);
        }

        $validator = Validator::make($request->all(), [
            'award_id' => 'required|numeric|between:1,4',
            'g-recaptcha-response' => 'recaptcha',
        ]);

        if ($validator->fails()) {
            $data = [
                'state' => false,
                'message' => $validator->errors()
            ];

            return response()->json($data);
        }

        if ($member->award_id != 0) {
            $data = [
                'state' => false,
                'message' => "{$member->udn} 已在 {$member->updated_at} 選取 no.{$member->award_id} 獎項"
            ];

            return response()->json($data);
        }

        $member->update(
            [
                'award_id' => $request->award_id,
            ]
        );

        $data = [
            'state' => true,
            'message' => '成功選取獎品'
        ];

        return response()->json($data);
    }

    public function me()
    {
        $user = auth('christmas')->user();
        if (!$user) {
            $data = [
                'state' => false,
                'message' => 'error'
            ];
            return response()->json($data);
        }
        $data = [
            'state' => true,
            'user' => $user
        ];
        return response()->json($data);
    }
}
