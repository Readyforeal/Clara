<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Approval Stages
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold mb-3">Create Approval Stage</p>

                <p class="text-xs mb-3">Fields marked with * are required</p>

                {{-- Make form into component --}}
                <form action="/approval-stages/create" method="POST">
                    @csrf

                    <div class="mt-2">
                        <x-label for="name" value="{{ __('Name *') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required/>
                    </div>

                    <div class="mt-2">
                        <x-label for="description" value="{{ __('description *') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />
                    </div>

                    <x-button class="mt-2">Create</x-button>
                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>