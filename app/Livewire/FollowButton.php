<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class FollowButton extends Component
{
    public $user;
    public $isFollowing;

    public $followersCount;

    public function mount(User $user){
        $this->user = $user;
        $this->isFollowing = auth()->user()->followings->contains($user->id);
        $this->followersCount = $user->followers()->count();
    }

    public function follow(){
        $currentUser = auth()->user();
        $currentUser->followings()->attach($this->user->user_id);
        $this->isFollowing = true;
        $this->followersCount++;
        \Log::info("User {$currentUser->user_id} followed user {$this->user->user_id}");
    }

    public function unfollow(){
        $currentUser = auth()->user();
        $currentUser->followings()->detach($this->user->user_id);
        $this->isFollowing = false;
        $this->followersCount--;
        \Log::info("User {$currentUser->user_id} followed user {$this->user->user_id}");
    }


    public function render()
    {
        return view('livewire.follow-button');
    }

}
