<div>
    <div class="flex justify-between py-4">

        <div>{{ count($selectedRows) }} Rows selected</div>

        <div class="flex gap-1">
            <livewire:create-user />
            <x-dropdown align="right">
                <x-slot name="trigger">
                    <span class="inline-flex rounded-md">
                        @if(count($selectedRows) === 0) 
                        <x-button disabled >Actions</x-button>

                        @else 
                        <x-button >Actions</x-button>
                        @endif
                    </span>
                </x-slot>

                <x-slot name="content">
                    <div class="">
                        <x-button class="text-xs w-full rounded-none" ghost="true" wire:click="bulk_activate">Activate</x-button>
                        <x-button class="text-xs w-full rounded-none" ghost="true" wire:click="bulk_disctivate">Disactivate</x-button>
                        <x-button class="text-xs w-full rounded-none text-red-500" ghost="true" wire:click="bulk_delete">Delete</x-button>
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
        <table class="w-full text-sm text-left dark:text-white">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b">
                <tr>
                    @foreach ($this->columns() as $column)
                        @if ($column->sortable)
                            <th wire:click="sort('{{ $column->key }}')" class="py-3 px-6 cursor-pointer">
                                <div class="flex items-center">
                                    {{ $column->label }}
                                    @if ($sortBy === $column->key)
                                        <span class="ml-1">
                                            @if ($sortDirection === 'asc')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                        </span>
                                    @endif
                                </div>
                            </th>
                        @else
                            <th class="py-3 px-6 ">
                                <div class="flex items-center">
                                    @if ($column->label == 'ID')
                                        <x-checkbox wire:click="selectAll($event.target.checked)" wire:model="allSelected"/>
                                    @else
                                        {{ $column->label }}
                                    @endif
                                </div>
                            </th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($this->data() as $row)
                    <tr class="border-b dark:hover:bg-gray-500 hover:bg-gray-200">
                        @foreach ($this->columns() as $column)
                            <td class="py-3 px-6">
                                @if ($column->label == 'ID')
                                    <x-checkbox wire:click="selectRow($event.target.value)" wire:model="selectedRows"
                                        value="{{ $row['id'] }}" />
                                @else
                                    <div class="flex items-center">
                                        <x-dynamic-component :component="$column->component" :value="$row[$column->key]" />
                                    </div>
                                @endif

                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 text-white">
        {{ $this->data()->links() }}
    </div>

</div>
