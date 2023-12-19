<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} {{ session()->has('projectName') ? ' - ' . session('projectName') : '' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/210158a457.js" crossorigin="anonymous"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="max-h-[calc(100vh-156px)] bg-white">
            @livewire('navigation-menu')

            {{-- Project Navigation --}}
            @if(session()->has('projectId'))
                @livewire('project-sidebar')
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="{{ session()->has('projectId') ? 'ml-[300px]' : '' }} mt-14 border-b border-gray-300 bg-white">
                    <div class="mx-auto p-6">
                        {{ $header }}
                        
                        {{-- Selections --}}
                        @if(session()->has('selectionListId'))
                        <div class="mt-1 inline-flex text-xs">
                            <a class="opacity-50 hover:opacity-100 transition ease-in-out" href="/selections">Selection Lists</a>
                            @if (session()->has('selectionId'))
                                <i class="fa fa-chevron-right mx-2 mt-1"></i><a class="opacity-50 hover:opacity-100 transition ease-in-out" href="/selection-list/{{ session('selectionListId') }}">{{ session('selectionListName') }}</a>
                            @endif
                        </div>
                        @endif


                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="{{ session()->has('projectId') ? 'ml-[300px]' : '' }}">
                {{ $slot }}
            </main>

        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
