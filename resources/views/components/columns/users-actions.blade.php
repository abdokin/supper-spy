@props(['value'])

<div class="flex gap-2">

    <x-dropdown align="right" width="60">
        <x-slot name="trigger">
            <span class="inline-flex rounded-md">
                <x-button secondary="true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </x-button>
            </span>
        </x-slot>

        <x-slot name="content">
            <div class="w-24">
                <x-button class="w-full rounded-none" ghost="true"
                    wire:click="$dispatch('user-edit',{user_id:{{ $value }} })"
                    wire:loading.attr="disabled">{{ __('Edit') }}</x-button>

                <x-button
                    class="w-full rounded-none text-red-600 hover:bg-red-700 dark:hover:bg-red-500 hover:text-white"
                    wire:click="$dispatch('user-delete',{user_id:{{ $value }} })" wire:loading.attr="disabled"
                    ghost="true">
                    {{ __('Delete') }}
                </x-button>
            </div>
        </x-slot>
    </x-dropdown>
</div>
