<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="p-3 max-w-3xl mx-auto bg-white border border-gray-300 rounded-md overflow-hidden">
            <p class="text-xl font-semibold mb-3">Create Selection List</p>

            <p class="text-xs mb-3">Fields marked with * are required</p>

            {{-- Make form into component --}}
            <form action="/selection-lists/create" method="POST">
                @csrf

                <div class="mt-2">
                    <x-label for="name" value="{{ __('Name *') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="off" />
                </div>

                <div class="mt-2">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autocomplete="off" />
                </div>

                <x-button class="mt-2" icon="arrow-right" color="blue">Create</x-button>
                
            </form>
        </div>
    </div>
</x-app-layout>