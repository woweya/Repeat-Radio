<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\UserActivity;
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
               $durationOnline = $user->last_online_at ? now()->diff($user->last_online_at) : now()->diff(now());
               $totalSeconds = $durationOnline->s + $durationOnline->i * 60 + $durationOnline->h * 3600;

               // Aggiorna l'attività dell'utente con la durata della sessione online
               UserActivity::updateOrCreate(
                   ['user_id' => $user->id],
                   ['hours_online' => DB::raw("hours_online + $totalSeconds"), 'hours_played' => 0]
               );
           }

       // Continua con la gestione della richiesta
       return $next($request);
    }
}
