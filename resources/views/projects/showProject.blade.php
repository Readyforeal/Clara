<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Home
        </h2>
    </x-slot>

    <div class="px-6">
        {{-- Action zone --}}
        <div>
            <p class="text-xl font-semibold">{{ $project->name }}</p>

            <x-secondary-button-link class="mt-2" icon="pen" url="/projects/{{ $project->id }}/edit">
                Edit Project
            </x-secondary-button-link>
        </div>

        {{-- Content --}}
        <div class="mt-3 max-w-1/2">
            <div class="p-3 bg-white border border-gray-300 shadow-md rounded-md overflow-hidden">                    
                <p>This is where we will provide quick access and recent data.</p>
            </div>
        </div>
    </div>
</x-app-layout>