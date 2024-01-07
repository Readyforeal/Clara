<x-project-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            <i class="fa fa-table-list mr-2"></i>Selection List
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        {{-- Action zone --}}
        <div>
            <x-icon-button-link class="mt-2 text-2xl" icon="arrow-left" url="/selection-lists/{{ $selectionList->id }}" />
        </div>

        <x-card class="mt-2">
            <x-slot name="head">
                <p>Edit Selection List</p>
            </x-slot>

            <x-slot name="body">
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
            </x-slot>
        </x-card>

        <x-card class="mt-2">
            <x-slot name="head">
                <p>Danger Zone</p>
            </x-slot>

            <x-slot name="body">
                <form action="/selection-lists/{{ $selectionList->id }}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button icon="trash">
                        Delete
                    </x-button>
                </form>
            </x-slot>
        </x-card>

    </div>
</x-project-layout>