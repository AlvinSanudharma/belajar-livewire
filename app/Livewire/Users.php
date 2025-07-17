<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public function createUser()
    {
        User::create([
            'name' => 'John doe',
            'email' => 'doe@email.com',
            'password' => Hash::make('password'),
        ]);
    }

    public function render()
    {
        return view('livewire.users', [
            'title' => "Users page",
            'users' => User::all()
        ]);
    }
}
