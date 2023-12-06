<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\User;

use App\Table\Column;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;


class CitiesTable extends Component {

    use WithPagination;
    public $perPage = 10;
    public $page = 1;
    public $selectedRows = [];
    public $sortBy = 'id';
    public $sortDirection = 'desc';
    public $allSelected = false;
    public $selectedStatuses = null;


    public function query(): Builder {
        return City::query()->join('regions', 'cities.region_id', '=', 'regions.id')
            ->select('cities.*', 'regions.name as region_name');
    }

    public function columns(): array {
        return [
            Column::make('id', 'ID'),
            Column::make('name', 'Name', true),
            Column::make('region_name', 'Region', true),
            Column::make('status', 'Status', true)->component('columns.cities.status'),
            Column::make('created_at', 'Created At', true)->component('columns.human-diff'),
            Column::make('id', 'Actions')->component('columns.cities.actions'),
        ];
    }




    #[On('load-cities-table')]
    public function reload() {
        $this->resetSelect();
        $this->render();
    }
    public function render() {
        return view('livewire.cities-table', [
            'data' => $this->data()
        ]);
    }



    #[Computed]
    public function data() {
        return $this
            ->query()

            ->when($this->sortBy !== '', function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->when($this->selectedStatuses !== null && count($this->selectedStatuses) > 0, function ($query) {
                $query->whereIn('cities.status', $this->selectedStatuses);
            })
            ->paginate($this->perPage);
    }

    public function sort($key) {
        $this->resetPage();

        if($this->sortBy === $key) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $key;
            $this->sortDirection = 'asc';
        }
    }
    public function selectAll($checked) {
        if($checked) {
            $this->selectedRows = $this->data()->pluck('id')->toArray();

        } else {
            $this->selectedRows = [];
        }
    }
    public function selectRow($value) {
        $value = intval($value);
    }
    public function addStatusFilter($status) {
        if($this->selectedStatuses) {
            if(in_array($status, $this->selectedStatuses)) {
                $this->selectedStatuses = array_diff($this->selectedStatuses, [$status]);
            } else {
                $this->selectedStatuses = array_merge($this->selectedStatuses, [$status]);
            }
        } else {
            $this->selectedStatuses = [$status];
        }

    }

    public function resetSelect() {
        $this->selectedRows = [];
        $this->allSelected = false;
    }

    function bulk_activate() {

        $citiesToUpdate = City::whereIn('id', $this->selectedRows)->get();
        foreach($citiesToUpdate as $user) {
            $user->status = 'active';
            $user->save();
        }
        $this->resetSelect();
        Toaster::success('cities has been chnaged to be active!');

    }

    function bulk_disctivate() {

        $citiesToUpdate = City::whereIn('id', $this->selectedRows)->get();
        foreach($citiesToUpdate as $user) {
            $user->status = 'inactive';
            $user->save();
        }
        $this->resetSelect();
        Toaster::success('cities has been chnaged to be insactive!');
    }
    function bulk_delete() {

        $citiesToUpdate = City::whereIn('id', $this->selectedRows)->get();
        foreach($citiesToUpdate as $user) {
            $user->status = 'deleted';
            $user->save();
        }
        Toaster::success('cities has been chnaged to be deleted!');
        $this->resetSelect();
    }

    public function resetFilter() {
        $this->selectedStatuses = null;
        $this->resetSelect();
    }
}



