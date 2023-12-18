<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            {{-- Project Navigation --}}
            @livewire('project-sidebar')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex">
                        <a class="opacity-50 hover:opacity-100" href="/projects">Projects</a>

                        @if(session()->has('projectId'))
                        <a class="opacity-50 hover:opacity-100 ml-4" href="/project/{{ session()->get('projectId') }}">Home</a>
                        <a class="opacity-50 hover:opacity-100 ml-4" href="/selections">Selections</a>
                        @endif

                        @if(session()->has('selectionListId'))
                        <a class="opacity-50 hover:opacity-100 ml-4" href="/selection-list/{{ session()->get('selectionListId') }}">Selection List</a>
                        @endif

                        @if(session()->has('selectionId'))
                        <a class="opacity-50 hover:opacity-100 ml-4" href="/selection/{{ session()->get('selectionId') }}">Selection</a>
                        @endif
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <div class="fixed bottom-0 bg-white/70 p-3">
                <p class="font-semibold">Session Info</p>
                <div>
                    <p>
                        Project ID:
                        <span class="font-semibold text-red-600">{{ session()->has('projectId') ? session('projectId') : '' }}</span>
                    </p>

                    <p>
                        Selection List ID:
                        <span class="font-semibold text-red-600">{{ session()->has('selectionListId') ? session('selectionListId') : '' }}</span>
                    </p>

                    <p>
                        Selection ID:
                        <span class="font-semibold text-red-600">{{ session()->has('selectionId') ? session('selectionId') : '' }}</span>
                    </p>

                    <p>
                        Item ID:
                        <span class="font-semibold text-red-600">{{ session()->has('itemId') ? session('itemId') : '' }}</span>
                    </p>
                </div>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
