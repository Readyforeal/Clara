<x-project-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Home
        </h2>
    </x-slot>

    {{-- Full Width --}}
    <div class="px-6">
        {{-- Action zone --}}
        <div>
            <x-secondary-button-link class="mt-2" icon="pen" url="/projects/{{ $project->id }}/edit">
                Edit Project
            </x-secondary-button-link>
        </div>

        {{-- Content --}}
        <x-card class="mt-3">
            <x-slot name="head">
                Project Info
            </x-slot>

            <x-slot name="body">
                <p>This is where we will provide quick access and recent data.</p>
            </x-slot>
        </x-card>

    </div>
</x-project-layout>