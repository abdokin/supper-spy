@props(['columns', 'data', 'sortBy', 'sortDirection', 'selectedRows', 'allSelected'])

<table class="w-full text-sm text-left dark:text-white">
    <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b">
        <tr>
            @foreach ($columns as $column)
                @if ($column->sortable)
                    <th wire:click="sort('{{ $column->key }}')" class="py-3 px-6 cursor-pointer ">
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
                    <th class="py-3 px-6  ">
                        <div class="flex items-center">
                            @if ($column->label == 'ID')
                                <x-checkbox wire:click="selectAll($event.target.checked)"
                                    wire:model="allSelected" />
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
        @foreach ($data as $row)
            <tr class="border-b dark:hover:bg-gray-500 hover:bg-gray-200 border-y">
                @foreach ($columns as $column)
                    <td class="py-3 px-6 ">
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
