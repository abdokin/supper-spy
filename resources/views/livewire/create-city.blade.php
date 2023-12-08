<div>

    <x-button class="ms-4"  secondary="true" wire:click="showModal" wire:loading.attr="disabled">New city
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
          </svg>
          
    </x-button>
    <x-dialog-modal wire:model="showingModal">
        <x-slot name="title">
            New  City
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" wire:model="name" autocomplete="name"
                    placeholder="Enter City name" />
                @error('name') <span>{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-label for="region_id" value="{{ __('Region ') }}" />
                <x-select name="region_id" id="region_id" wire:model="region_id">
                    <option value="-1">Please Select Region</option>

                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ ucfirst($region->name) }}</option>
                    @endforeach
                </x-select>
                @error('region_id') <span>{{ $message }}</span> @enderror
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="hideModal" wire:loading.attr="disabled">
                cancel
            </x-secondary-button>

            <x-button class="ml-2" wire:loading.attr="disabled" wire:click="save">
                save
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>