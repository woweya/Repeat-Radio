<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;


class SearchUsers extends Component
{
    public $searchTerm= '';

    public $vip = false;  // Assuming you have a VIP filter
    public $staff = false;  // Assuming you have a Staff filter
    public $users = [];

    public $roles = [];
    public $hasSearched = false;
    public $filterResults = [];


    public function render()
    {

        return view('livewire.search-users', [
            'users' => $this->users,
            'hasSearched' => $this->hasSearched,
        ]);
    }

    public function search(){
        $query = \App\Models\User::query();


        // Apply search term filter
        if (!empty($this->searchTerm)) {
            $query->where(function($query) {
                $query->where('username', 'like', $this->searchTerm . '%')
                      ->orWhere('name', 'like', $this->searchTerm . '%')
                      ->orWhere('email', 'like', $this->searchTerm . '%');
            });
        }else{
            $this->searchTerm = '';
            $this->hasSearched = false;
            $this->users = [];
        }

       /*  // Apply VIP filter
        if ($this->vip) {
            $query->where('is_vip', true);
        } */



        // Apply Staff filter
        if ($this->staff) {
            $query->where('is_staff', true);
            $this->roles = \App\Models\Role::all();

        }

        if (!empty($this->searchTerm) || $this->vip || $this->staff) {
            // If any search is applied, get the filtered users

            $this->users = $query->get();
        } else {
            // If all filters are empty, reset users to an empty array
            $this->users = [];
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['searchTerm', 'filterResults.0'])) {
            $this->hasSearched = true;

            if ($this->filterResults) {
                $this->staff = true;
                $this->search();
            }else{
                $this->staff = false;
                $this->search();
            }


        }
    }


}
