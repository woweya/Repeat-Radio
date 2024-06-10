<?php

namespace App\Listeners;

use App\Events\UserAvatars;
use Laravolt\Avatar\Avatar;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserAvatarListener
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(UserAvatars $event)
    {
        $user = $event->user;

        if (!$user->image) {
            $avatar = new Avatar();
            $avatarPath = $avatar->create($user->username)->save(public_path('storage/Avatars/avatar-' . $user->username . '.png'), 100);
        }
    }
}
