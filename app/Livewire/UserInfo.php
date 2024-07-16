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

    public $updatedInfos = [];  //USE THIS PROPERTY TO UPDATE THE USER INFO.
    public function render()
    {
        return view('livewire.user-info')->layout('components.layout');
    }



    public function loadUser($userID)
    {
        $this->user = \App\Models\User::find($userID);
    }



    //HERE U CAN MANAGE TO EDIT USER INFO, USE WIRE:MODEL TO PASS THE USER VALUES.
    //$userID it's being called by the Settings button near the top h1.
    public function editUser($userID)
    {

        $this->user = \App\Models\User::find($userID);


    }
}
