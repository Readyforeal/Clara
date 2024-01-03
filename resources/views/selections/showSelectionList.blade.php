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
        <x-card class="mt-3">
            <x-slot name="body">
                @livewire('selection-list-table', ['selectionListId' => $selectionList->id])
            </x-slot>
        </x-card>
    </div>
</x-project-layout>