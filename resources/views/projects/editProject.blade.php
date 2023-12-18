<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold mb-3">Edit Project</p>

                <p class="text-xs mb-3">Fields marked with * are required</p>

                {{-- Make form into component --}}
                <form action="/project/{{ $project->id }}/edit" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mt-2">
                        <x-label for="name" value="{{ __('Name *') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$project->name" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-2">
                        <x-label for="street" value="{{ __('Street *') }}" />
                        <x-input id="street" class="block mt-1 w-full" type="text" name="street" :value="$project->street" required/>
                    </div>

                    <div class="mt-2">
                        <x-label for="city" value="{{ __('City *') }}" />
                        <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="$project->city" required/>
                    </div>

                    <div class="mt-2">
                        <x-label for="state" value="{{ __('State *') }}" />
                        <x-input id="state" class="block mt-1 w-full" type="text" name="state" :value="$project->state" required/>
                    </div>

                    <div class="mt-2">
                        <x-label for="zip" value="{{ __('Zip *') }}" />
                        <x-input id="zip" class="block mt-1 w-full" type="text" name="zip" :value="$project->zip" required/>
                    </div>

                    <div class="mt-2">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$project->description"/>
                    </div>

                    <x-button class="mt-2">Update</x-button>
                    
                </form>

                <form class="mt-3" action="/project/{{ $project->id }}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button>Delete</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>