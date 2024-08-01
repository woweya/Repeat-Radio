<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

class SearchUsers extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $searchTerm = '';
    public $vip = false;  // VIP filter
    public $staff = false;  // Staff filter

    public $isLoading = false;


    public function mount()
    {
        $this->searchTerm = '';
        $this->vip = false;
        $this->staff = false;

    }

    #[On('songUpdated')]
    public function getFilteredUsersProperty()
    {

        $query = \App\Models\User::query();

        $this->isLoading = false;

        if ($this->searchTerm) {

            $query->where(function ($subQuery) {
                $subQuery->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('username', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            });

        }

        if ($this->vip) {
            $query->where('is_vip', true);
        }

        if ($this->staff) {
            $query->where('is_staff', true);

        }

        return $query->paginate(10);
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'staff' || $propertyName === 'searchTerm' || $propertyName === 'vip') {
            $this->resetPage();
            $this->getFilteredUsersProperty();
        }
    }



    public function render()
    {
        $AllUsers = \App\Models\User::paginate(10);

        return view('livewire.search-users', [
            'users' => $this->searchTerm || $this->vip || $this->staff ? $this->filteredUsers : $AllUsers,
        ]);
    }
}
