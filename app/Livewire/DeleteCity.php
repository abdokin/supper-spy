<?php

namespace App\Livewire;

use App\Models\city;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class DeleteCity extends Component
{

    public $city;
    public $showingModal = false;


    public function render()
    {
        return view('livewire.delete-city');
    }

    public function delete() {
        $this->city->delete();
        $this->hideModal();
        $this->dispatch("load-cities-table");
        Toaster::success('City Deleted!');
    }

    #[On('city-delete')]
    public function showModal($city_id)
    {
        $this->city = City::findOrFail($city_id);
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }
}
