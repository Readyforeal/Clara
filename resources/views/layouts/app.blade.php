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

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex">
                        <a href="/projects">Projects</a>

                        @if(session()->has('project_id'))
                        <a class="ml-2" href="/project/{{ session()->get('project_id') }}">Home</a>
                        <a class="ml-2" href="/selections">Selections</a>
                        @endif
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <div class="fixed bottom-0 p-3">
                <p>Project ID: {{ session()->get('project_id') }}</p>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
