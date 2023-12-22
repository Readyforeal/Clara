<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ $selectionList->name }}
        </h2>
    </x-slot>

    <div class="px-6">
        <div class="flex justify-between">
            <x-secondary-button-link icon="pen" url="/selection-list/{{ $selectionList->id }}/edit">Edit Selection List</x-secondary-button-link>
        </div>

        <div class="mt-3 p-3 bg-white border border-gray-300 rounded-md overflow-hidden">
            <x-button-link icon="plus" url="/selection/create">Create Selection</x-button-link>

            <div class="mt-3">
                @foreach ($selectionList->selections as $selection)
                    <div class="flex text-xs py-1">
                        <a href="/selection/{{ $selection->id }}" class="font-semibold">{{ $selection->name }}</a>
                        <p class="ml-2">
                            @forelse ($selection->items as $item)
                                {{ $item->name }}
                            @empty
                                <span class="text-yellow-600">Selection Needed</span>
                            @endforelse
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>