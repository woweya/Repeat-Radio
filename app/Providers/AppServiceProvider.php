<?php

namespace App\Providers;


use Livewire\Livewire;
use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        //! Laravel Telescope for local development
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //EVENT FOR DISCORD
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
        });



        // SHARE AVATAR IMAGE WITH VIEWS
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



/*
        $categories = \App\Models\Category::all();
        view()->share('categories', $categories);
 */

    }

}
