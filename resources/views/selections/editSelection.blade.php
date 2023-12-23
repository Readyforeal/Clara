<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold mb-3">Edit Selection</p>

                <p class="text-xs mb-3">Fields marked with * are required</p>

                {{-- Make form into component --}}
                <form action="/selections/{{ $selection->id }}/edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <p class="font-semibold">Selection Info</p>

                    <div class="mt-2">
                        <x-label for="name" value="{{ __('Name *') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$selection->name" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-2">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$selection->description" />
                    </div>

                    <div class="mt-2">
                        <x-label for="quantity" value="{{ __('Quantity') }}" />
                        <x-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="$selection->quantity" />
                    </div>

                    <x-button class="mt-2" icon="pen-to-square" color="blue">Update</x-button>
                    
                </form>

                <form class="mt-3" action="/selections/{{ $selection->id }}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button icon="trash" color="blue">Delete</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>