<?php

namespace App\Livewire;

use App\Models\User;

use App\Table\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;


class UsersTable extends Component
{

    use WithPagination;
    public $perPage = 10;
    public $page = 1;
    public $selectedRows = [];
    public $sortBy = 'id';
    public $sortDirection = 'desc';
    public $allSelected =false;


    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID'),
            Column::make('name', 'Name', true),
            Column::make('email', 'Email'),
            Column::make('status', 'Status')->component('columns.users-status'),
            Column::make('created_at', 'Created At')->component('columns.human-diff'),
            Column::make('id', 'Actions')->component('columns.users-actions'),
        ];
    }




    #[On('load-users-table')]
    public function render()
    {
        return view('livewire.users-table', [
            'data' => $this->data()
        ]);
    }


    #[Computed]
    public function data()
    {
        return $this
            ->query()
            ->when($this->sortBy !== '', function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->perPage);
    }

    public function sort($key)
    {
        $this->resetPage();

        if ($this->sortBy === $key) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $key;
            $this->sortDirection = 'asc';
        }
    }
    public function selectAll($checked)
    {
        if ($checked) {
            $this->selectedRows = $this->data()->pluck('id')->toArray();

        } else {
            $this->selectedRows = [];
        }
    }
    public function selectRow($value)
    {
        $value = intval($value);
    }

    public function resetSelect() {
        $this->selectedRows =[];
        $this->allSelected = false;
    }

    function bulk_activate()
    {

        $usersToUpdate = User::whereIn('id', $this->selectedRows)->get();
        foreach ($usersToUpdate as $user) {
            $user->status = 'active';
            $user->save();
        }
        $this->resetSelect();
        Toaster::success('Users has been chnaged to be active!');

    }

    function bulk_disctivate()
    {

        $usersToUpdate = User::whereIn('id', $this->selectedRows)->get();
        foreach ($usersToUpdate as $user) {
            $user->status = 'inactive';
            $user->save();
        }
        $this->resetSelect();
        Toaster::success('Users has been chnaged to be insactive!');
    }
    function bulk_delete()
    {

        $usersToUpdate = User::whereIn('id', $this->selectedRows)->get();
        foreach ($usersToUpdate as $user) {
            $user->status = 'deleted';
            $user->save();
        }
        Toaster::success('Users has been chnaged to be deleted!');
        $this->resetSelect();
    }
}



