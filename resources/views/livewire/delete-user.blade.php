<div>

    
    <x-confirmation-modal wire:model="showingModal">
        <x-slot name="title">
            Delete Account
        </x-slot>

        <x-slot name="content">
            Are you sure you want to delete your account? Once your account is deleted, all of its resources and data
            will be permanently deleted.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showingModal')" wire:loading.attr="disabled">
                Nevermind
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                Delete Account
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>