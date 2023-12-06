<div>

    <x-dialog-modal wire:model="showingModal">
        <x-slot name="title">
            Edit City
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" wire:model="name" autocomplete="name"
                    placeholder="Enter City name" />
                @error('city.name') <span>{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <x-label for="region_id" value="{{ __('Region ') }}" />
                <x-select name="region_id" id="region_id" wire:model="region_id">
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ ucfirst($region->name) }}</option>
                    @endforeach
                </x-select>
                @error('city.region_id') <span>{{ $message }}</span> @enderror
            </div>
            
            <div class="mt-4">
                <x-label for="status" value="{{ __('Status') }}" />
                <x-select name="status" id="status" wire:model="status">
                    @foreach(\App\Models\User::STATUSES as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </x-select>
                @error('status') <span>{{ $message }}</span> @enderror
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="hideEditModal" wire:loading.attr="disabled">
                cancel
            </x-secondary-button>

            <x-button class="ml-2" wire:loading.attr="disabled" wire:click="edit">
                save
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>