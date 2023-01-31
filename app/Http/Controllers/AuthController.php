<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect($drive)
    {
        return Socialite::driver($drive)->redirect();
    }

    public function callback($drive)
    {
        $githubUser = Socialite::driver($drive)->user();
        dump(Auth::user());
        dd($githubUser);
        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ],[
            'name' => $githubUser->getNickname(),
            'email' => $githubUser->email,
            'avatar' => $githubUser->avatar,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }
}
