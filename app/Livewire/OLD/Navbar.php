<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $user;
    public function render()
    {

        return view('livewire.navbar');
    }


    public function loadUser()
    {
        return redirect()->route('user', ['id' => Auth::user()->id]);
    }

}
