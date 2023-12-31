<x-project-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Selection Lists
        </h2>
    </x-slot>

    {{-- Full Width --}}
    <div class="px-6">

        {{-- Action zone --}}
        <div>
            <x-button-link class="mt-2" icon="add" url="/selection-lists/create">
                Create List
            </x-button-link>
        </div>

        {{-- Content --}}
        <x-card class="mt-3">
            <x-slot name="head">
                Your Lists
            </x-slot>

            <x-slot name="body">
                @foreach ($selectionLists as $selectionList)
                <a class="@if(!$loop->first) mt-2 @endif flex group justify-between border border-gray-300 rounded-md p-3 bg-white hover:bg-gray-100 opacity-70 hover:opacity-100 transition ease-in-out" href="/selection-lists/{{ $selectionList->id }}">
                    <span class="font-semibold">
                        <i class="fa fa-table-list mr-2 group-hover:text-blue-500 transition ease-in-out"></i>
                        {{ $selectionList->name }}
                    </span>

                    <span>
                        {{ $selectionList->selections->count() }} Selections
                    </span>
                </a>
                @endforeach
            </x-slot>
        </x-card>

    </div>
</x-project-layout>