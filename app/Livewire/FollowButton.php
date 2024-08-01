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
        $this->isFollowing = $user->followings()->where('followed_id', $user->id)->exists();
        $this->followersCount = $user->followers()->count();
        \Log::info("Mount: User {$this->user->user_id} is following: " . ($this->isFollowing ? 'Yes' : 'No'));

    }

    public function follow(){
        $currentUser = auth()->user();
        $currentUser->followings()->attach($this->user->id);
        $this->isFollowing = true;
        $this->followersCount++;
        \Log::info("User {$currentUser->user_id} followed user {$this->user->user_id}");
    }

    public function unfollow(){
        $currentUser = auth()->user();
        $currentUser->followings()->detach($this->user->id);
        $this->isFollowing = false;
        $this->followersCount--;
        \Log::info("User {$currentUser->user_id} followed user {$this->user->user_id}");
    }


    public function render()
    {
        return view('livewire.follow-button');
    }

}
