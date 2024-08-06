<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CalculateTopUsersActivity
{
    public function handle($request, Closure $next)
    {
        // Retrieve all online users
        $onlineUsers = User::where('is_online', true)->get();

        foreach ($onlineUsers as $user) {
            // Calculate the user's online session duration
            $lastOnlineAt = new Carbon($user->last_online_at);
            $currentOnlineDuration = $lastOnlineAt->diffInSeconds(now());

            // Find or create the UserActivity record
            $userActivity = UserActivity::firstOrNew(['user_id' => $user->id]);

            // Increment the hours_online
            $userActivity->hours_online = $userActivity->hours_online + $currentOnlineDuration;
            $userActivity->hours_played = $userActivity->hours_played ?? 0; // Ensure hours_played is not null
            $userActivity->save();

            // Update the user's last online timestamp
            $user->last_online_at = now();
            $user->save();
        }

        // Continue with the request handling
        return $next($request);
    }
}
