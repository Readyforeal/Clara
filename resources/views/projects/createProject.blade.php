<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Project
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold mb-3">Create Project</p>
                
                <p class="text-xs mb-3">Fields marked with * are required</p>

                {{-- Make form into component --}}
                <form action="/projects/create" method="POST">
                    @csrf

                    <div class="mt-2">
                        <x-label for="name" value="{{ __('Name *') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-2">
                        <x-label for="street" value="{{ __('Street *') }}" />
                        <x-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required/>
                    </div>

                    <div class="mt-2">
                        <x-label for="city" value="{{ __('City *') }}" />
                        <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
                    </div>

                    <div class="mt-2">
                        <x-label for="state" value="{{ __('State *') }}" />
                        <x-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state')" required />
                    </div>

                    <div class="mt-2">
                        <x-label for="zip" value="{{ __('Zip *') }}" />
                        <x-input id="zip" class="block mt-1 w-full" type="text" name="zip" :value="old('zip')" required />
                    </div>

                    <div class="mt-2">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required />
                    </div>

                    <x-button class="mt-2">Create</x-button>
                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>