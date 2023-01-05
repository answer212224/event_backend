<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\BdPhoto;
use Illuminate\Http\Request;
use App\Models\BdPhotoMember;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Validator;


class BdPhotoController extends Controller
{
    public function __construct()
    {

        // 6 月 27 日至 7 月 7 日上傳投稿。
        // 7 月 8 日至 7 月 17 日進行投票。
        // 7 月 20 日得獎公告。

        // 投稿開始 ~ 投票結束
        $this->appStart = Carbon::createFromFormat('Y-m-d', '2022-06-27')->startOfDay();
        $this->appEnd = Carbon::createFromFormat('Y-m-d', '2022-07-17')->endOfDay();

        // 投稿開始 ~ 投搞結束
        $this->postStart = Carbon::createFromFormat('Y-m-d', '2022-06-27')->startOfDay();
        $this->postEnd = Carbon::createFromFormat('Y-m-d', '2022-07-07')->endOfDay();

        // 投票開始 ~ 投搞結束
        $this->voteStart = Carbon::createFromFormat('Y-m-d', '2022-07-08')->startOfDay();
        $this->voteEnd = Carbon::createFromFormat('Y-m-d', '2022-07-17')->endOfDay();

        // 得獎頁面開始 ~ 得獎頁面結束
        $this->winnerStart = Carbon::createFromFormat('Y-m-d', '2022-07-20')->startOfDay();
        $this->winnerEnd = Carbon::createFromFormat('Y-m-d', '2030-07-20')->endOfDay();

        $this->appState = now()->between($this->appStart, $this->appEnd);
        $this->postState = now()->between($this->postStart, $this->postEnd);
        $this->voteState = now()->between($this->voteStart, $this->voteEnd);
        $this->winnerState = now()->between($this->winnerStart, $this->winnerEnd);
    }


    public function index(Request $request)
    {

        $pets = BdPhoto::query();

        $pets->where('name', 'like', "%{$request->search}%")->withCount('votes')->latest('votes_count')->latest();

        $pets = $pets->paginate(12)->appends($request->query());

        return response()->json([
            'pets' => $pets,
            'state' => true
        ]);
    }

    public function state()
    {
        return response()->json([
            'eventStatus' => $this->appState,
            'applyStatus' => $this->postState,
            'voteStatus' => $this->voteState,
            'winnerStatus' => $this->winnerState,
        ]);
    }

    public function login(Request $request)
    {




        $response = getUdnMember($request->udnmember, urlencode($request->um2));

        if (!$response || $response['response']['status'] != 'success') {
            return response()->json([
                'state' => false,
                'error' => '此帳號非udn會員'
            ]);
        }

        $member = BdPhotoMember::firstOrCreate(
            [
                'udn' => $request->udnmember
            ],
            [
                'email' => $response['response']['email'],
            ]
        );


        $jwt = auth('bd_photos')->setTTL(129600)->login($member);

        return response()->json([
            'state' => true,
            'jwt' => $jwt,
        ]);
    }


    public function storePet(Request $request)
    {
        if (!$this->postState) {
            return response()->json([
                'state' => false,
                'error' => '不再活動時間範圍內!'
            ]);
        }
        $member = auth('bd_photos')->user();

        if (!$member) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:5120',
            'name' => 'required|max:20',
            'description' => 'required|max:150',
            'token' => 'recaptcha',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all()
            ]);
        };

        $file = $request->image;

        $fileName = $file->hashName();


        $storage = new StorageClient([
            'keyFilePath' => storage_path('app/gcppgw-188809-4f502cc8651a.json')
        ]);

        $bucket = $storage->bucket('event-backend');

        $bucket->upload(
            fopen($file->path(), 'r'),
            [
                'name' => 'photos/' . $fileName
            ]
        );


        $member->pets()->create([
            'image' => $fileName,
            'name' => $request->name,
            'description' => $request->description
        ]);


        return response()->json([
            'state' => true,
            'fileName' => $fileName,
            'message' => 'upload successfully'
        ]);
    }


    public function storeVote(Request $request)
    {
        if (!$this->voteState) {
            return response()->json([
                'state' => false,
                'error' => '不再活動時間範圍內!'
            ]);
        }

        $member = auth('bd_photos')->user();

        if (!$member) {
            return response()->json(['error' => '請重新登入!'], 401);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:bd_photos|numeric',
            'token' => 'recaptcha',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all()
            ]);
        };

        $vote = $member->votes()->whereDate('created_at', today())->first();

        if ($vote) {
            return response()->json([
                'state' => false,
                'error' => "今日已投過票"
            ]);
        }

        $member->votes()->create([
            'bd_photo_id' => $request->id,
            'ip' => getIp()
        ]);

        return response()->json([
            'state' => true,
            'message' => 'voted successfully'
        ]);
    }
}
