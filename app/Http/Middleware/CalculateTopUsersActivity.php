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
    // Ottenere tutti gli utenti online
    $onlineUsers = User::where('is_online', true)->get();

    foreach ($onlineUsers as $user) {
        // Calcola la durata della sessione online dell'utente
        $lastOnlineAt = new Carbon($user->last_online_at);
        $currentOnlineDuration = $lastOnlineAt->diffInSeconds(now());

        // Aggiorna l'attività dell'utente con la durata della sessione online
        UserActivity::updateOrCreate(
            ['user_id' => $user->id],
            ['hours_online' => DB::raw("hours_online + $currentOnlineDuration"), 'hours_played' => 0]
        );

        // Aggiorna il timestamp dell'ultimo aggiornamento
        $user->last_online_at = now();
        $user->save();
    }

    // Continua con la gestione della richiesta
    return $next($request);
}
}
