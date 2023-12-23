<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Selection Lists
        </h2>
    </x-slot>

    <div class="px-6">
        <div class="max-w-1/2">
            <div class="p-3 bg-white border border-gray-300 shadow-md rounded-md overflow-hidden">    
                <x-button-link icon="plus" url="/selection-lists/create" class="mb-1">Create</x-button-link>
                
                @foreach ($selectionLists as $selectionList)
                    <a class="mt-2 flex group justify-between border border-gray-300 rounded-md p-3 bg-white hover:bg-gray-100 opacity-70 hover:opacity-100 transition ease-in-out" href="/selection-lists/{{ $selectionList->id }}">
                        <span class="font-semibold">
                            <i class="fa fa-table-list mr-2 group-hover:text-blue-500 transition ease-in-out"></i>
                            {{ $selectionList->name }}
                        </span>
    
                        <span>
                            {{ $selectionList->selections->count() }} Selections
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>