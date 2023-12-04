<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditUser extends Component
{
    public User $user;
    public $name;
    public $email;
    public $status;


    public $showingModal = false;

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email',
        'user.status' => [
            'required',
            // Rule::in(['active', 'inactive', 'deleted']), 
        ],
    ];
    public function render()
    {
        return view('livewire.edit-user');
    }

    public function edit()
    {
        $this->validate($this->rules);

        $existingUser = User::where('email', $this->email)
            ->where('id', '!=', $this->user->id)
            ->first();

        if ($existingUser) {
            $this->addError('email', 'The email has already been taken.');
            return;
        }
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
        ]);
        $this->dispatch("load-users-table");
        $this->hideEditModal();
        Toaster::success('User Edited!');

    }

    #[On("user-edit")]
    public function showEditModal($user_id)
    {

        $this->user = User::findOrFail($user_id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->status = $this->user->status;
        $this->showingModal = true;
    }

    public function hideEditModal()
    {
        $this->showingModal = false;
    }
}
