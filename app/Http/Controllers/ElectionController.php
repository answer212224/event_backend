<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ElectionVote;
use Illuminate\Http\Request;
use App\Models\ElectionMember;
use Illuminate\Validation\Rule;
use App\Models\ElectionCandidate;
use App\Models\ElectionClick;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ElectionController extends Controller
{
    private $min = 1440;
    // private $min = 1;

    public function index()
    {

        $candidates = ElectionCandidate::withCount('votes')->get();

        $gb = $candidates->groupBy('city');

        $gb['台北市']->transform(function ($item, $key)  use ($gb) {;
            if ($gb['台北市']->sum('votes_count') == 0) {
                return [
                    'candidate' => $item,
                    'pct' => 0
                ];
            } else {
                return [
                    'candidate' => $item,
                    'pct' => intval($item->votes_count  /  $gb['台北市']->sum('votes_count') * 100)
                ];
            }
        });

        $gb['新北市']->transform(function ($item, $key)  use ($gb) {;
            if ($gb['新北市']->sum('votes_count') == 0) {
                return [
                    'candidate' => $item,
                    'pct' => 0
                ];
            } else {
                return [
                    'candidate' => $item,
                    'pct' => intval($item->votes_count  /  $gb['新北市']->sum('votes_count') * 100)
                ];
            }
        });

        $gb['桃園市']->transform(function ($item, $key)  use ($gb) {;
            if ($gb['桃園市']->sum('votes_count') == 0) {
                return [
                    'candidate' => $item,
                    'pct' => 0
                ];
            } else {
                return [
                    'candidate' => $item,
                    'pct' => intval($item->votes_count  /  $gb['桃園市']->sum('votes_count') * 100)
                ];
            }
        });

        $gb['台中市']->transform(function ($item, $key)  use ($gb) {;
            if ($gb['台中市']->sum('votes_count') == 0) {
                return [
                    'candidate' => $item,
                    'pct' => 0
                ];
            } else {
                return [
                    'candidate' => $item,
                    'pct' => intval($item->votes_count  /  $gb['台中市']->sum('votes_count') * 100)
                ];
            }
        });

        $gb['台南市']->transform(function ($item, $key)  use ($gb) {;
            if ($gb['台南市']->sum('votes_count') == 0) {
                return [
                    'candidate' => $item,
                    'pct' => 0
                ];
            } else {
                return [
                    'candidate' => $item,
                    'pct' => intval($item->votes_count  /  $gb['台南市']->sum('votes_count') * 100)
                ];
            }
        });

        $gb['高雄市']->transform(function ($item, $key)  use ($gb) {;
            if ($gb['高雄市']->sum('votes_count') == 0) {
                return [
                    'candidate' => $item,
                    'pct' => 0
                ];
            } else {
                return [
                    'candidate' => $item,
                    'pct' => intval($item->votes_count  /  $gb['高雄市']->sum('votes_count') * 100)
                ];
            }
        });
        return response()->json([
            'state' => true,
            'data' => $gb
        ]);
    }

    public function candidates()
    {
        $candidates = ElectionCandidate::get()->sortBy('number')->groupBy('city');

        return response()->json([
            'state' => true,
            'data' => $candidates
        ]);
    }

    public function verify(Request $request)
    {
        $response = getUdnMember($request->header('udnmember'), urlencode($request->header('um2')));

        if (empty($response) || $response['response']['status'] != 'success') {
            return response()->json([
                'state' => false,
                'error' => 'please check your account'
            ]);
        }

        $member = ElectionMember::firstOrCreate(
            [
                'udn' => $request->header('udnmember')
                // 'udn' => 'udn030068'
            ],
            [
                'email' => $response['response']['email'],
                // 'email' => 'answer212224@gmail.com',
                'ip' => getIp()
            ]
        );

        $token = auth('elections')->setTTL(129600)->login($member);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('elections')->factory()->getTTL() * 60
        ]);
    }

    public function storeVote(Request $request)
    {

        $member = auth('elections')->user();

        if (!$member) {
            return response()->json([
                'state' => false,
                'error' => 'please check your access_token'
            ]);
        }

        $activity = Activity::find(1);

        if (now() < $activity->start_at) {
            return response()->json([
                'state' => false,
                'error' => "game dose not start"
            ]);
        }

        if (now() > $activity->end_at) {
            return response()->json([
                'state' => false,
                'error' => "game over"
            ]);
        }

        $validator = Validator::make($request->all(), [

            'g-recaptcha-response' => 'required|recaptcha',
            'votes'  => [
                'required',
                'array',
                'size:6',
            ],
            'votes.Taipei.id'  => [
                'required',
                'exists:App\Models\ElectionCandidate,id'
            ],
            'votes.NewTaipei.id'  => [
                'required',
                'exists:App\Models\ElectionCandidate,id'
            ],
            'votes.Taoyuan.id'  => [
                'required',
                'exists:App\Models\ElectionCandidate,id'
            ],
            'votes.Taichung.id'  => [
                'required',
                'exists:App\Models\ElectionCandidate,id'
            ],
            'votes.Tainan.id'  => [
                'required',
                'exists:App\Models\ElectionCandidate,id'
            ],
            'votes.Kaoshiung.id'  => [
                'required',
                'exists:App\Models\ElectionCandidate,id'
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'state' => false,
                'error' => $validator->errors()
            ]);
        };

        $vote = $member->votes()->orderBy('updated_at', 'desc')->first();

        if ($vote) {
            $finishChanged = $vote->updated_at->addMinutes($this->min);

            $countClick = $member->clicks()->whereBetween('created_at', [now()->subMinutes($this->min), now()])->count();

            if ($finishChanged->greaterThan(now())) {
                return response()->json([
                    'state' => false,
                    'error' => "not yet"
                ]);
            } else if ($countClick < 3) {
                return response()->json([
                    'state' => false,
                    'error' => 'click less than 3',
                ]);
            }
        }

        $member->votes()->updateOrCreate(
            [
                'city' => 'Taipei'
            ],
            [
                'election_candidate_id' => $request->votes['Taipei']['id'],
                'ip' => getIp()
            ]
        );

        $member->votes()->updateOrCreate(
            [
                'city' => 'NewTaipei'
            ],
            [
                'election_candidate_id' => $request->votes['NewTaipei']['id'],
                'ip' => getIp()
            ]
        );

        $member->votes()->updateOrCreate(
            [
                'city' => 'Taoyuan'
            ],
            [
                'election_candidate_id' => $request->votes['Taoyuan']['id'],
                'ip' => getIp()
            ]
        );

        $member->votes()->updateOrCreate(
            [
                'city' => 'Taichung'
            ],
            [
                'election_candidate_id' => $request->votes['Taichung']['id'],
                'ip' => getIp()
            ]
        );

        $member->votes()->updateOrCreate(
            [
                'city' => 'Tainan'
            ],
            [
                'election_candidate_id' => $request->votes['Tainan']['id'],
                'ip' => getIp()
            ]
        );

        $member->votes()->updateOrCreate(
            [
                'city' => 'Kaoshiung'
            ],
            [
                'election_candidate_id' => $request->votes['Kaoshiung']['id'],
                'ip' => getIp()
            ]
        );

        return response()->json([
            'state' => true,
            'message' => 'nice'
        ]);
    }

    public function getVote()
    {
        $activity = Activity::find(1);

        $member = auth('elections')->user();

        if (!$member) {
            return response()->json([
                'state' => false,
                'error' => 'please check your access_token'
            ]);
        }

        $vote = $member->votes()->orderBy('updated_at', 'desc')->first();


        if (!$vote) {
            return response()->json([
                'state' => true,
                'data' => $vote,
                'member' => $member->udn,
                'message' => 'first times vote',
            ]);
        }

        $finishChanged = $vote->updated_at->addMinutes($this->min);

        $changedInMin = $finishChanged->diffInMinutes(now());

        $data = $member->votes->load('candidate')->groupBy('city');
        $countClick = $member->clicks()->whereBetween('created_at', [now()->subMinutes($this->min), now()])->count();


        $voteEnd = $activity->end_at->subDays(2);

        if (now() < $activity->start_at) {
            return response()->json([
                'state' => false,
                'data' => $data,
                'error' => 'game dose not start',
                'member' => $member->udn,
                'is_app' =>  $member->is_app,
                'time' => $changedInMin,
                'click' => $countClick,
            ]);
        }

        if (now() > $activity->end_at) {
            return response()->json([
                'state' => false,
                'data' => $data,
                'error' => 'game over',
                'member' => $member->udn,
                'is_app' =>  $member->is_app,
                'time' => $changedInMin,
                'click' => $countClick,
            ]);
        }

        if (now()->greaterThan($voteEnd)) {
            return response()->json([
                'state' => false,
                'data' => $data,
                'error' => 'has been end',
                'member' => $member->udn,
                'is_app' =>  $member->is_app,
                'time' => $changedInMin,
                'click' => $countClick,
            ]);
        } else if ($finishChanged->greaterThan(now())) {
            return response()->json([
                'state' => false,
                'data' => $data,
                'error' => 'not yet',
                'member' => $member->udn,
                'is_app' =>  $member->is_app,
                'finish' => $finishChanged->format("Y-m-d H:i:s"),
                'time' => $changedInMin,
                'click' => $countClick,
            ]);
        } else if ($countClick < 3) {
            return response()->json([
                'state' => false,
                'data' => $data,
                'error' => 'click less than 3',
                'time' => $changedInMin,
                'member' => $member->udn,
                'is_app' =>  $member->is_app,
                'click' => $countClick,
            ]);
        } else {
            return response()->json([
                'state' => true,
                'data' => $data,
                'message' => 'can update',
                'member' => $member->udn,
                'is_app' =>  $member->is_app,
                'click' => $countClick,
            ]);
        }
    }

    public function click()
    {
        $member = auth('elections')->user();

        if (!$member) {
            return response()->json([
                'state' => false,
                'error' => 'please check your access_token'
            ]);
        }
        $member->clicks()->create([]);

        return response()->json([
            'state' => true,
            'message' => 'good'
        ]);
    }

    public function app()
    {
        $member = auth('elections')->user();

        if (!$member) {
            return response()->json([
                'state' => false,
                'error' => 'please check your access_token'
            ]);
        }

        $member->update([
            'is_app' => true
        ]);

        return response()->json([
            'state' => true,
            'message' => 'is_app was changed'
        ]);
    }

    public function isVoted()
    {
        $member = auth('elections')->user();

        if (!$member) {
            return response()->json([
                'state' => false,
                'error' => 'please check your access_token'
            ]);
        }

        $member = $member->withCount('votes')->get();

        if ($member->votes_count >= 6) {
            return response()->json([
                'state' => true,
                'message' => 'has predicted'
            ]);
        } else {
            return response()->json([
                'state' => false,
                'error' => 'no prediction'
            ]);
        }
    }

    public function state()
    {

        $activity = Activity::find(1);

        if (now() < $activity->start_at) {
            return response()->json([
                'state' => false,
                'error' => 'game dose not start',

            ]);
        }

        if (now() > $activity->end_at) {
            return response()->json([
                'state' => false,
                'error' => 'game over',
            ]);
        }


        return response()->json([
            'state' => true,
            'message' => 'good morning',
            'data' => [
                'start_at' => $activity->start_at->toDateTimeString(),
                'end_at' => $activity->end_at->toDateTimeString(),
            ]
        ]);
    }
}
