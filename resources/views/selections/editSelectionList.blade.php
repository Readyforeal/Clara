<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold mb-3">Edit Selection List</p>

                <p class="text-xs mb-3">Fields marked with * are required</p>

                {{-- Make form into component --}}
                <form action="/selection-list/{{ $selectionList->id }}/edit" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mt-2">
                        <x-label for="name" value="{{ __('Name *') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$selectionList->name" required autofocus autocomplete="name" />
                    </div>

                    <x-button class="mt-2">Update</x-button>
                    
                </form>

                <form class="mt-3" action="/selection-list/{{ $selectionList->id }}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button>Delete</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>