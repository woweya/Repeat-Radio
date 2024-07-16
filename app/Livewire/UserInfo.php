<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\View\Components\layout;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class UserInfo extends Component
{
    use WithFileUploads;
    public $image;
    public $user;
    public function render()
    {
        return view('livewire.user-info')->layout('components.layout');
    }



    public function loadUser($userID)
    {
        $this->user = \App\Models\User::find($userID);
    }


    public function editUser($userID)
    {

        $this->user = \App\Models\User::find($userID);

    }
}
