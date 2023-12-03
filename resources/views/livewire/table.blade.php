<div>

  <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-md">
    <table class="w-full text-sm text-left text-white">
      <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b">
        <tr>
          @foreach($this->columns() as $column)
          <th wire:click="sort('{{ $column->key }}')" class="py-3 px-6 cursor-pointer">
            <div class="flex items-center">
              {{ $column->label }}
              @if($column->label != "Actions" && $sortBy === $column->key)
              <span class="ml-1">
                @if ($sortDirection === 'asc')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" viewBox="0 0 20 20"
                  fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block" viewBox="0 0 20 20"
                  fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                    clip-rule="evenodd" />
                </svg>
                @endif
              </span>
              @endif
            </div>
          </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($this->data() as $row)
        <tr class="border-b hover:bg-gray-500">
          @foreach($this->columns() as $column)
          <td class="py-3 px-6">
            <div class="flex items-center">
              <x-dynamic-component :component="$column->component" :value="$row[$column->key]"/>
            </div>
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