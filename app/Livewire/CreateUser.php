<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\User;
use Masmerise\Toaster\Toaster;

class CreateUser extends Component
{
    #[Validate('required')]

    public $name;
    #[Validate('required|email|unique:users,email')]
    public $email;

    public $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
    public $showingModal = false;
    

    public function render()
    {
        return view('livewire.create-user');
    }

    public function save()
    {
        $this->validate();
        User::create(
            $this->only(['name', 'email', 'password']),
        );
        $this->reset(['name', 'email']);
        $this->hideCreateModal();
        $this->dispatch("load-users-table");
        Toaster::success('User created!');

    }
    public function showCreateModal()
    {
        $this->showingModal = true;
    }

    public function hideCreateModal()
    {
        $this->showingModal = false;
    }
}
