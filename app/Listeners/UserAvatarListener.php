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

    public $user;

    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(UserAvatars $event): void
    {
        $this->user = $event->user;
        if (!$this->user->image) {
            $avatar = new Avatar();
            $avatarPath = $avatar->create($this->user->username)->save(public_path('storage/Avatars/avatar-' . $this->user->username . '.png'), 100);
        }
    }
}
