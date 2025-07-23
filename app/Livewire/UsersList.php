<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public $query = '';

    public function search() {
        $this->resetPage();
    }

    #[On('user-created')]
    public function updatedQuery() {
        $this->resetPage();
    }

    #[Computed]
    public function users() {
        return User::latest()->where('name', 'like', '%'.$this->query.'%')->paginate(5);
    }

    public function deleteUser($id) {
        $user = User::where('id', $id)->firstOrFail();

        $user->delete();

        session()->flash('success', 'User successfully deleted.');
    }

    public function placeholder() {
        return view('livewire.placeholder.skeleton');
    }

    public function render()
    {
        return view('livewire.users-list');

    }
}
