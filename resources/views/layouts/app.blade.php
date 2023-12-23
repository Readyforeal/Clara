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
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="max-h-[calc(100vh-156px)] bg-white">
            @livewire('navigation-menu')

            {{-- Project Navigation --}}
            @if(session()->has('roadmap.project.projectId'))
                @livewire('project-sidebar')
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="{{ session()->has('roadmap.project') ? 'ml-[300px]' : '' }} mt-14 bg-white">
                    <div class="mx-auto p-6">
                        {{ $header }}
                        
                        {{-- Selections --}}
                        @if(session()->has('roadmap.project.selectionList'))
                        <div class="inline-flex text-xs">
                            <a class="opacity-50 hover:opacity-100 transition ease-in-out" href="/selection-lists">Selection Lists</a>
                            @if (session()->has('roadmap.project.selectionList.selection'))
                                <i class="fa fa-chevron-right mx-2 mt-[2px]"></i>
                                <a class="opacity-50 hover:opacity-100 transition ease-in-out" href="/selection-lists/{{ session('roadmap.project.selectionList.selectionListId') }}">
                                    <i class="fa fa-table-list mr-2 mt-[0px]"></i>{{ session('roadmap.project.selectionList.selectionListName') }}    
                                </a>
                            @endif
                        </div>
                        @endif

                        {{-- Approvals --}}
                        @if(session()->has('roadmap.project.approvalStage'))
                        <div class="inline-flex text-xs">
                            <a class="opacity-50 hover:opacity-100 transition ease-in-out" href="/approval-stages">Approval Stages</a>
                        </div>
                        @endif


                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="{{ session()->has('roadmap.project') ? 'ml-[300px]' : '' }}">
                {{ $slot }}
            </main>

            {{-- Toast --}}
            <x-toast class="{{ session('message.type') == 'success' ? 'bg-blue-100 text-blue-400' : 'bg-red-100 text-red-400' }}"></x-toast>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
