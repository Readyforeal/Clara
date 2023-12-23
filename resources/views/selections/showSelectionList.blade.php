<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            <i class="fa fa-table-list mr-2"></i>Selection List
        </h2>
    </x-slot>

    <div class="px-6">
        {{-- Action zone --}}
        <div>
            <p class="text-xl font-semibold">{{ $selectionList->name }}</p>
            @if (isset($selectionList->description))
                <p>{{ $selectionList->description }}</p>
            @endif
            <x-secondary-button-link class="mt-2" icon="pen" url="/selection-lists/{{ $selectionList->id }}/edit">
                Edit List
            </x-secondary-button-link>
        </div>

        {{-- Content --}}
        <div class="mt-3 p-3 bg-white border border-gray-300 rounded-xl overflow-hidden">
            <x-button-link icon="plus" url="/selections/create">Create Selection</x-button-link>

            <div class="mt-3">
                @foreach ($selectionList->selections as $selection)
                    <div class="flex text-xs py-1">
                        <a href="/selections/{{ $selection->id }}" class="font-semibold">{{ $selection->name }}</a>
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