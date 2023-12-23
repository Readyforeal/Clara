<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        {{-- Action zone --}}
        <div>
            <p class="text-xl font-semibold">Edit Selection List</p>
            <x-secondary-button-link class="mt-2" icon="arrow-left" url="/selection-lists">
            
            </x-secondary-button-link>
        </div>

        <div class="mt-3 p-6 bg-white border border-gray-300 rounded-xl overflow-hidden">
            <div>
                <p class="text-xs">Fields marked with * are required</p>
    
                {{-- Make form into component --}}
                <form action="/selection-lists/{{ $selectionList->id }}/edit" method="POST">
                    @csrf
                    @method('PATCH')
    
                    <div class="mt-2">
                        <x-label for="name" value="{{ __('Name *') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$selectionList->name" required autofocus autocomplete="off" />
                    </div>
    
                    <div class="mt-2">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$selectionList->description" autocomplete="off" />
                    </div>
    
                    <x-button class="mt-3"
                        icon="pen-to-square"
                    >
                        Update
                    </x-button>
                    
                </form>
            </div>

            <div class="mt-3">
                <p class="text-xl font-semibold">Danger Zone</p>

                <form action="/selection-lists/{{ $selectionList->id }}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button class="mt-2"
                        icon="trash"
                    >
                        Delete
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>