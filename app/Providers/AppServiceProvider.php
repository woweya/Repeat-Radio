<?php

namespace App\Providers;


use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use SocialiteProviders\Discord\Provider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
        });

        $avatarImage = null; // Inizializza $avatarImage a null

        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->image) {
                $avatar = new Avatar();
                // Utilizza l'istanza di Avatar per generare l'immagine
                $avatarImage = $avatar->create($user->username)->setFontFamily('Lato')->toSvg();
            } else {
                $avatarImage = $user->image->path;
            }
        }

        view()->share('avatarImage', $avatarImage); // Condividi $avatarImage con le viste
    }

}
