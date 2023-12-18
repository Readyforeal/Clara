<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">

                <a class="opacity-50 hover:opacity-100" href="/project/{{ $project->id }}/edit">Edit</a>

                <p>Project Home</p>

                <p>This is where we will provide quick access and recent data</p>
            </div>
        </div>
    </div>
</x-app-layout>