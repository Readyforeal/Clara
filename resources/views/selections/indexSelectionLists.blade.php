<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Selections
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="p-3 max-w-3xl mx-auto bg-white border border-gray-300 rounded-md overflow-hidden">
            <p class="text-xl font-semibold">Selection Lists</p>
            
            <a class="inline-block mt-2" href="/selection-list/create">
                <x-button @click.prevent="$root.submit();"><i class="fa fa-plus mr-2 text-xs text-blue-400"></i>Create</x-button>
            </a>
            
            @foreach ($selectionLists as $selectionList)
                <a class="flex mt-3 group justify-between border border-gray-300 rounded-md p-3 bg-white hover:bg-gray-100 opacity-70 hover:opacity-100 transition ease-in-out" href="/selection-list/{{ $selectionList->id }}">
                    <span class="font-semibold">
                        <i class="fa fa-table-list mr-2 group-hover:text-blue-400 transition ease-in-out"></i>
                        {{ $selectionList->name }}
                    </span>

                    <span>
                        {{ $selectionList->selections->count() }} Selections
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>