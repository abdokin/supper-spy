<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\City;
use Masmerise\Toaster\Toaster;

class CreateCity extends Component
{
    #[Validate('required|unique:cities,name')]
    public $name;
    #[Validate('required|exists:regions,id')]
    public $region_id;

    public $showingModal = false;
    public $regions;

    public function mount() {
        $this->regions = Region::all();

    }
    public function render()
    {
        return view('livewire.create-city');
    }

    public function save()
    {
        $this->validate();
        City::create(
            $this->only(['name', 'region_id']),
        );
        $this->reset(['name', 'region_id']);
        $this->hideModal();
        $this->dispatch("load-cities-table");
        Toaster::success('City created!');

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
