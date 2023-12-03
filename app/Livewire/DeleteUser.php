<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class DeleteUser extends Component
{

    public $user;
    public $showingModal = false;

    public function mount($user_id) {
        $this->user = User::findOrFail($user_id);
    }
    public function render()
    {
        return view('livewire.delete-user');
    }

    public function deleteUser() {
        $this->user->delete();
        $this->hideModal();
        $this->dispatch("load-table");
        Toaster::success('User Deleted!');
    }

    public function showModal()
    {
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }
}
