<?php

namespace App\Livewire;

use App\Models\User;
use \App\Livewire\Table;

use App\Table\Column;
use Illuminate\Database\Eloquent\Builder;


class UsersTable extends Table
{

    public $sortBy = 'id';
    public $sortDirection = 'desc';


    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id', 'ID'),
            Column::make('name', 'Name'),
            Column::make('email', 'Email'),
            Column::make('status', 'Status')->component('columns.users-status'),
            Column::make('created_at', 'Created At')->component('columns.human-diff'),
            Column::make('id', 'Actions')->component('columns.users-actions'),
        ];
    }

}
