<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    {{-- Floating Center --}}
    <div class="max-w-2xl mx-auto">
        {{-- Content Block --}}
        <div class="p-3 bg-white border border-gray-300 rounded-xl overflow-hidden">

            <x-button-link icon="plus" url="/projects/create" class="mb-1">Create Project</x-button-link>
            @foreach ($projects as $project)
                <p><a href="/projects/{{ $project->id }}">{{ $project->name }}</a></p>
            @endforeach

        </div>
    </div>
</x-app-layout>