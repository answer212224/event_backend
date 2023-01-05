<?php

namespace App\Http\Controllers;

use App\Models\FoodClick;
use App\Models\FoodForm;
use App\Models\FoodMember;
use App\Models\FoodMemberForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class FoodController extends Controller
{
    public function index()
    {
        // dd($member);
        // $member = FoodMember::find(11);
        // $member->load('foodMemberForms');
        // dd($member->foodMemberForms()->where('date_only', today()->subDay()->format('Y-m-d'))->first());
        // $token = auth('food')->login($member);
        // dd(getIp());
        // Log::debug("message");
        if (now() >= '2021-12-02 10:48:00') {
            dd('coming soon');
        }
    }

    public function store(Request $request)
    {
        if (today()->format('Y-m-d') < '2021-11-22') {
            $data = [
                'state' => false,
                'message' => '活動於 2021.11.22 00:00:00 開始，敬請期待'

            ];

            return response()->json($data);
        }

        if (now() > '2021-12-05 23:59:00') {
            $data = [
                'state' => false,
                'message' => '活動於 2021-12-05 23:59:00 結束，敬請期待結果'
            ];

            return response()->json($data);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|regex:/^09[0-9]{8}$/',
            'email' => 'required|email',
            'check_box' => 'accepted'
        ]);

        if ($validator->fails()) {
            $data = [
                'state' => false,
                'message' => $validator->errors()
            ];

            return response()->json($data);
        }


        $foodFormByEamilAndToday = FoodForm::where('date_only', today()->format('Y-m-d'))
            ->where(function ($query) use ($request) {
                $query->where('email', $request->email);
            })->first();

        if ($foodFormByEamilAndToday) {
            $data = [
                'state' => false,
                'message' => [
                    "此Email: $foodFormByEamilAndToday->email 今日已填"
                ]
            ];

            return response()->json($data);
        }

        $foodForm = FoodForm::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'date_only' => today()->format('Y-m-d'),
            'ip' => getIp(),
        ]);

        $data = [
            'state' => true,
            'member' => $foodForm
        ];

        return response()->json($data);
    }

    public function isAccess()
    {
        if (today()->format('Y-m-d') < '2021-11-22') {
            $data = [
                'state' => false,
                'message' => '活動於 2021.11.22 00:00:00 開始，敬請期待'

            ];

            return response()->json($data);
        }

        if (now() > '2021-12-05 23:59:00') {
            $data = [
                'state' => false,
                'message' => '活動於 2021-12-05 23:59:00 結束，敬請期待結果'
            ];

            return response()->json($data);
        }

        $data = [
            'state' => true,
            'ip' => getIp(),
        ];
        return response()->json($data);
    }

    public function click()
    {
        if (today()->format('Y-m-d') < '2021-11-22') {
            $data = [
                'state' => false,
                'message' => '活動於 2021.11.22 00:00:00 開始，敬請期待'

            ];

            return response()->json($data);
        }

        if (now() > '2021-12-05 23:59:00') {
            $data = [
                'state' => false,
                'message' => '活動於 2021-12-05 23:59:00 結束，敬請期待結果'
            ];

            return response()->json($data);
        }

        FoodClick::create([
            'ip' => getIp(),
        ]);

        $data = [
            'state' => true,
            'ip' => getIp(),
        ];

        return response()->json($data);
    }

    public function storeMember(Request $request)
    {
        $user = auth('food')->user();

        if (!$user) {
            $data = [
                'state' => false,
                'message' => 'jwt error'
            ];
            return response()->json($data, 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|regex:/^09[0-9]{8}$/',
            'email' => 'required|email',
            'check_box' => 'accepted'
        ]);

        if ($validator->fails()) {
            $data = [
                'state' => false,
                'message' => $validator->errors()
            ];

            return response()->json($data);
        }

        $user->load('foodMemberForms');
        $userFormByDateOnly = $user->foodMemberForms()->where('date_only', today()->format('Y-m-d'))->first();
        if ($userFormByDateOnly) {

            $data = [
                'state' => false,
                'message' => $user->name . ' 今日已填過表單'
            ];

            return response()->json($data);
        };

        $foodMemberForm = $user->foodMemberForms()->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'date_only' => today()->format('Y-m-d'),
            'ip' => getIp(),
        ]);

        $data = [
            'state' => true,
            'user' => $foodMemberForm
        ];

        return response()->json($data);
    }

    public function clickMember()
    {
        $user = auth('food')->user();

        if (!$user) {
            $data = [
                'state' => false,
                'message' => 'jwt error'
            ];
            return response()->json($data, 401);
        }

        $user->foodMemberClicks()->create([
            'ip' => getIp(),
        ]);

        $data = [
            'state' => true,
            'user' => $user
        ];

        return response()->json($data);
    }

    public function me()
    {
        $user = auth('food')->user();
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

    public function logout()
    {
        auth('food')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        try {
            $token = auth('food')->refresh();
        } catch (Exception $e) {
            return response()->json([
                'state' => false,
                'message' => 'jwt error'
            ], 401);
        }
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'state' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('food')->factory()->getTTL() * 60
        ]);
    }

    public function fb()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $member = FoodMember::updateOrCreate(
                [
                    'fb' => $user->id
                ],
                [
                    'ip' => getIp(),
                    'name' => $user->name,
                    'email' => $user->email
                ]
            );
            $token = auth('food')->login($member);
            return redirect('https://lab-event.udn.com/2021food/?access_token=' . $token);
        } catch (InvalidStateException $e) {
            return redirect('https://lab-event.udn.com/2021food');
        }
    }
}
