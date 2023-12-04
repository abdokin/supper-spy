<div>

    <x-dialog-modal wire:model="showingModal">
        <x-slot name="title">
            Edit user
        </x-slot>

        <x-slot name="content">
            <div class="mt-4 w-full">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" wire:model="email" autocomplete="email"
                    placeholder="Enter user email" />
                @error('user.email') <span>{{ $message }}</span> @enderror

            </div>
            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" wire:model="name" autocomplete="name"
                    placeholder="Enter user name" />
                @error('user.name') <span>{{ $message }}</span> @enderror
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

            <x-danger-button class="ml-2" wire:loading.attr="disabled" wire:click="edit">
                save
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>