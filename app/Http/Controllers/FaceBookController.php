<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FaceBookController extends Controller
{
    public function fb(Request $request)
    {
        return Socialite::driver('facebook')->scopes(['email'])->with(['state' => $request->redirect])->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            return redirect($request->state . '?name=' . $user->name . '&email=' . $user->email);
        } catch (InvalidStateException $e) {
            return redirect($request->state);
        }
    }
}
