<div>
    <div class="flex justify-between py-4">
        <div class="flex gap-1 items-center">
            <livewire:create-city />
            @if (count($selectedRows) > 0)
                <x-dropdown align="right">
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <x-button>Bulk Action
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>

                            </x-button>
                        </span>
                    </x-slot>
                    <x-slot name="content">
                        <div class="">
                            <x-button class="text-xs w-full rounded-none" ghost="true" wire:click="bulk_activate">Mark
                                Activate</x-button>
                            <x-button class="text-xs w-full rounded-none" ghost="true"
                                wire:click="bulk_disctivate">Mark Inactive</x-button>
                            <x-button class="text-xs w-full rounded-none text-red-500" ghost="true"
                                wire:click="bulk_delete">Mark Delete</x-button>
                        </div>
                    </x-slot>
                </x-dropdown>
                <x-button class="text-base" :secondary="true">Export</x-button>

                <div>{{ count($selectedRows) }} cities selected</div>
            @endif
        </div>
        <div class="flex gap-1 items-center">
            <div class="flex justify-end gap-1 border">
                <x-button ghost="true" :secondary="in_array('active', $selectedStatuses ?? [])" class="text-base rounded-none"
                    wire:click="addStatusFilter('active')">Active</x-button>

                <x-button ghost="true" :secondary="in_array('inactive', $selectedStatuses ?? [])" class="text-base rounded-none"
                    wire:click="addStatusFilter('inactive')">Inactive</x-button>

                <x-button ghost="true" :secondary="in_array('deleted', $selectedStatuses ?? [])" class="text-base rounded-none"
                    wire:click="addStatusFilter('deleted')">Delete</x-button>
            </div>
            <x-input class=" h-fit" wire:model.live.debounce.250ms="searchName" placeholder="search by name " />
        </div>
    </div>

    <div class="overflow-x-auto  border border-gray-200 shadow-md">
        <x-table :columns="$this->columns()" :data="$data" :sortBy="$sortBy" :sortDirection="$sortDirection" :selectedRows="$selectedRows"
            :allSelected="$allSelected" />

    </div>
    <div class="mt-4 text-white">
        {{ $this->data()->links() }}
    </div>

</div>
