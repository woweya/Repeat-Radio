<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;


class SearchUsers extends Component
{
    public $searchTerm= '';

    public $searchResults = [];

    public function render()
    {
        $users = [];
        if (!empty($this->searchTerm)) {
            $users = \App\Models\User::where(function($query) {
                $query->where('username', 'like', $this->searchTerm . '%')
                      ->orWhere('name', 'like', $this->searchTerm . '%')
                      ->orWhere('email', 'like', $this->searchTerm . '%');
            })
            ->get();
        }

        return view('livewire.search-users', ['users' => $users]);
    }


    public function search()
    {
        $this->searchResults = \App\Models\User::search($this->searchTerm)->get();
    }




}
