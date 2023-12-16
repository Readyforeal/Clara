<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold mb-3">Selection Lists</p>
                
                <a class="block my-3 opacity-50 hover:opacity-100" href="/selection-list/create">Create</a>
                
                @foreach ($selectionLists as $selectionList)
                    <a class="block opacity-50 hover:opacity-100" href="/selection-list/{{ $selectionList->id }}">
                        {{ $selectionList->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>