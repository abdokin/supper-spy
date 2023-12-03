<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $page = 1;
    public $sortBy = '';
    public $sortDirection = 'asc';

    #[On('load-table')]
    public function render()
    {
        return view('livewire.table', [
            'data' => $this->data()
        ]);
    }

    public abstract function query();

    public abstract function columns(): array;

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
}
