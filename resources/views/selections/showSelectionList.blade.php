<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold mb-3">{{ $selectionList->name }}</p>

                <div>
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
    </div>
</x-app-layout>