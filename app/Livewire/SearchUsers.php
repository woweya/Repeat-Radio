<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\WithoutUrlPagination;

class SearchUsers extends Component
{
    use WithPagination;

    public $search = '';
    public $staff = false;
    public $vip = false;



    public function updating($name, $value)
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->search = '';
        $this->staff = false;
        $this->vip = false;
    }
    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('username', 'like', '%' . $this->search . '%');
        }

        if ($this->staff) {
            $query->where('is_staff', true);
        }

        if ($this->vip) {
            $query->where('is_vip', true);
        }

        $users = $query->paginate(10);

        return view('livewire.search-users', [
            'users' => $users,
        ]);
    }
}
