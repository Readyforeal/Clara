<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Selections
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="p-3 bg-white border border-gray-300 rounded-md overflow-hidden">
            <p class="font-semibold">Selection Lists</p>
            
            <a class="inline-block my-3" href="/selection-list/create">
                <x-button @click.prevent="$root.submit();">Create</x-button>
            </a>
            
            @foreach ($selectionLists as $selectionList)
                <a class="block opacity-50 hover:opacity-100" href="/selection-list/{{ $selectionList->id }}">
                    {{ $selectionList->name }}
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>