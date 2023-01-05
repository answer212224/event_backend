<?php

namespace App\Http\Controllers;

use App\Models\BdAnimalMember;
use App\Models\BdAnimalPet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Google\Cloud\Storage\StorageClient;


class BdAnimalController extends Controller
{
    public function __construct()
    {
        $this->appStart = Carbon::create(2022, 4, 28);
        $this->appEnd = Carbon::create(2022, 5, 22 + 1);

        $this->postStart = Carbon::create(2022, 5, 3);
        $this->postEnd = Carbon::create(2022, 5, 12 + 1);

        $this->voteStart = Carbon::create(2022, 5, 13);
        $this->voteEnd = Carbon::create(2022, 5, 22 + 1);

        $this->winnerStart = Carbon::create(2022, 5, 24);
        $this->winnerEnd = Carbon::create(2030, 8, 1 + 1);

        $this->appState = now()->between($this->appStart, $this->appEnd) ? true : false;
        $this->postState = now()->between($this->postStart, $this->postEnd) ? true : false;
        $this->voteState = now()->between($this->voteStart, $this->voteEnd) ? true : false;
        $this->winnerState = now()->between($this->winnerStart, $this->winnerEnd) ? true : false;
    }


    public function index(Request $request)
    {

        $pets = BdAnimalPet::query();

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

        $response = getUdnMember($request->udnmember, urlencode($request->um2));

        if (!$response || $response['response']['status'] != 'success') {
            return response()->json([
                'state' => false,
                'error' => '此帳號非udn會員'
            ]);
        }

        $member = BdAnimalMember::firstOrCreate(
            [
                'udn' => $request->udnmember
            ],
            [
                'email' => $response['response']['email'],
            ]
        );


        $jwt = auth('bd_animals')->setTTL(129600)->login($member);

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
        $member = auth('bd_animals')->user();

        if (!$member) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|max:5120',
            'name' => 'required|max:20',
            'description' => 'required|max:150',
            // 'token' => 'recaptcha',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()->all()
            ]);
        };

        // $w = Storage::allFiles('/');

        // dd($w);

        $file = $request->image;

        $fileName = $file->hashName();



        $path = $request->image->move(storage_path('app/public/animals'), $fileName);

        // $img = Image::make($path);
        // $img->resize(460, null, function ($constraint) {
        //     $constraint->aspectRatio();
        // });

        // return $img->response('jpg');

        $storage = new StorageClient([
            'keyFilePath' => storage_path('app/gcppgw-188809-4f502cc8651a.json')
        ]);

        $bucket = $storage->bucket('event-backend');

        $bucket->upload(
            fopen($path, 'r'),
            [
                'name' => 'pets/' . $fileName
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

        $member = auth('bd_animals')->user();
        // $member = BdAnimalMember::find(3);

        if (!$member) {
            return response()->json(['error' => '請重新登入!'], 401);
        }

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:bd_animal_pets|numeric',
            // 'token' => 'recaptcha',
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
            'bd_animal_pet_id' => $request->id,
            'ip' => getIp()
        ]);

        return response()->json([
            'state' => true,
            'message' => 'voted successfully'
        ]);
    }
}
