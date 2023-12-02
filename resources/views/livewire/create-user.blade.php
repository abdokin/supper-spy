<div>

    <x-button class="ms-4" wire:click="showCreateModal" wire:loading.attr="disabled">
        {{ __('Create') }}
    </x-button>
    <x-dialog-modal wire:model="showingModal">
        <x-slot name="title">
            Create Users
        </x-slot>

        <x-slot name="content">

            <div class="mt-4 w-full">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" wire:model="email" autocomplete="email"  placeholder="Enter user email"/>
                @error('email') <span>{{ $message }}</span> @enderror

            </div>


            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" wire:model="name" autocomplete="name" placeholder="Enter user name" />
                @error('name') <span>{{ $message }}</span> @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="hideCreateModal" wire:loading.attr="disabled">
                cancel
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:loading.attr="disabled" wire:click="save">
                save
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>