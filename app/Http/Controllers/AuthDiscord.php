<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthDiscord extends Controller
{
    public function redirectToDiscord(){
        return Socialite::driver('discord')->redirect();
    }

    public function handleDiscordCallback(){
        $discordUser = Socialite::driver('discord')->user();


        $user =  User::where('discord_id', $discordUser->id)
                ->orWhere('email', $discordUser->email)
                ->first();

      if($user){
        $user->update([
            'discord_username' => $discordUser->nickname,
            'discord_id' => $discordUser->id,
            'discord_avatar' => $discordUser->avatar,
            'discord_email' => $discordUser->email
        ]);

        Auth::login($user, true);

      }else{
          // Create a new user
            $user = User::create([
                'name' => $discordUser->name,
                'email' => $discordUser->email,
                'username' => $discordUser->nickname,
                'birthday' => $discordUser->birthday,
                'gender' => $discordUser->gender,
                'discord_id' => $discordUser->id,
                'discord_username' => $discordUser->nickname,
                'discord_avatar' => $discordUser->avatar,
                'password' => bcrypt(Str::random(16)), // Set a random password
            ]);

            $Image = $user->image()->create(['path' => $discordUser->avatar]);

                $token = Password::createToken($user);
                Password::sendResetLink(['email' => $user->email]);
      }

         Auth::login($user, true);

         return redirect('/');
    }


}
