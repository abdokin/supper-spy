<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Region;
use Livewire\Attributes\On;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditCity extends Component
{

    public City $city;
    public $name;
    public $region_id;
    public $regions;

    public $status;

    public $showingModal = false;
    public function mount() {
        $this->regions = Region::all();
    }

    protected $rules = [
        'city.name' => 'required|string|max:255', 
        'city.region_id' => 'required|exists:regions,id',
        'city.status' => 'required|in:active,inactive,deleted', 
    ];
    
    
    public function render()
    {
        return view('livewire.edit-city');
    }


    public function edit()
    {
        $this->validate($this->rules);

        $existingCity = City::where('name', $this->name)
            ->where('id', '!=', $this->city->id)
            ->first();

        if ($existingCity) {
            $this->addError('name', 'The name has already been taken.');
            return;
        }
        $this->city->update([
            'name' => $this->name,
            'region_id' => $this->region_id,
            'status' => $this->status,
        ]);
        $this->dispatch("load-cities-table");
        $this->hideEditModal();
        Toaster::success('City Edited!');

    }

    #[On("city-edit")]
    public function showEditModal($city_id)
    {

        $this->city = City::findOrFail($city_id);
        $this->name = $this->city->name;
        $this->region_id = $this->city->region_id;
        $this->status = $this->city->status;
        $this->showingModal = true;
    }

    public function hideEditModal()
    {
        $this->showingModal = false;
    }
}
