<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class DeleteUser extends Component
{

    public $user;
    public $showingModal = false;


    public function render()
    {
        return view('livewire.delete-user');
    }

    public function deleteUser() {
        $this->user->delete();
        $this->hideModal();
        $this->dispatch("load-users-table");
        Toaster::success('User Deleted!');
    }

    #[On('user-delete')]
    public function showModal($user_id)
    {
        $this->user = User::findOrFail($user_id);
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }
}
