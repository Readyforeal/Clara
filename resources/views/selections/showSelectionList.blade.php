<x-project-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            <i class="fa fa-table-list mr-2"></i>Selection List
        </h2>
    </x-slot>

    {{-- Full Width --}}
    <div class="px-6">
        {{-- Action zone --}}
        <div>
            <p class="text-xl font-semibold flex items-center">
                {{ $selectionList->name }}
                <span class="flex-shrink-0 h-full flex items-center">
                    <x-icon-button-link icon="pen" url="/selection-lists/{{ $selectionList->id }}/edit" />
                </span>
            </p>
            @if (isset($selectionList->description))
                <p>{{ $selectionList->description }}</p>
            @endif
        </div>

        {{-- Content --}}
        <div class="mt-3 p-3 bg-white border border-gray-300 rounded-xl overflow-hidden">
            @livewire('selection-list-table', ['selectionListId' => $selectionList->id])
            {{-- @foreach ($selectionList->selections as $selection)
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
            @endforeach --}}
        </div>
    </div>
</x-project-layout>