<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|email|unique:users')]
    public $email = '';

     #[Validate('nullable|image|max:1024')]
    public $avatar;

    public $avatarPreview;

    public $id;

    public function updatedAvatar()
    {
        if ($this->avatar) {
            $this->avatarPreview = $this->avatar->temporaryUrl();
        }
    }

    #[Computed]
    public function user() {
       return User::findOrFail($this->id);
    }

    public function mount() 
    {
        $user = $this->user;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->avatarPreview = $user->avatar ? Storage::url($user->avatar) : null;
    }

    public function updateUser() {
        $validated = $this->validate();

        if ($this->avatar) {
            if (!empty($this->user->avatar)) {
                Storage::disk('public')->delete($this->user->avatar);
            }

            $validated['avatar'] = $this->avatar->store('avatar', 'public');
        }

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->avatar) {
            $data['avatar'] = $validated['avatar'];
        }

        $this->user->update($data);

        $this->reset();

        session()->flash('success', 'User successfully updated.');

        $this->redirectIntended('/users');
    }

    public function render()
    {
        return view('livewire.update');
    }
}
