<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class AuthDiscord extends Controller
{
    public function redirectToDiscord(){
        return Socialite::driver('discord')->redirect();
    }

    public function handleDiscordCallback(){
        $user = Socialite::driver('discord')->user();
        dd($user);
    }
}
