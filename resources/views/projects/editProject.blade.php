<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Home
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        {{-- Action zone --}}
        <div>
            <p class="text-xl font-semibold">Edit Project</p>
            <x-secondary-button-link class="mt-2" icon="arrow-left" url="/projects/{{ $project->id }}">
                Back
            </x-secondary-button-link>
        </div>

        <div class="mt-3 p-6 bg-white border border-gray-300 rounded-xl overflow-hidden">

            <p class="font-semibold mb-3">Edit Project</p>

            <p class="text-xs mb-3">Fields marked with * are required</p>

            {{-- Make form into component --}}
            <form action="/projects/{{ $project->id }}/edit" method="POST">
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

            <form class="mt-3" action="/projects/{{ $project->id }}/delete" method="POST">
                @csrf
                @method('DELETE')
                <x-button>Delete</x-button>
            </form>
        </div>
    </div>
</x-app-layout>