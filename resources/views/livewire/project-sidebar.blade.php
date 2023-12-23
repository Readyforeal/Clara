<div class="fixed w-[300px] top-14 bottom-0">
    <div class="w-full h-full bg-white text-black border-r border-gray-300">
        <div class="h-full flex flex-col">
            {{-- Project information --}}
            <div class="px-6 mt-6">
                <p class="text-xl font-semibold text-blue-500">{{ $project->name }}</p>
                <p class="text-xs">{{ $project->street }}</p>
                <p class="text-xs">{{ $project->city }}, {{ $project->state }} {{ $project->zip }}</p>
                <p>{{ $project->description }}</p>
            </div>

            {{-- Navigation --}}
            <div class="flex-grow p-6">
                @livewire('project-sidebar-link', [
                    'link' => '/projects/' . $project->id,
                    'icon' => 'fa fa-fw fa-home',
                    'label' => 'Home',
                    'highlighted' => (function() {
                        return request()->routeIs('projects.show');
                    })(),
                ])

                @livewire('project-sidebar-link', [
                    'link' => '/selection-lists',
                    'icon' => 'fa fa-fw fa-check-circle',
                    'label' => 'Selections',
                    'highlighted' => (function() {
                        return session('feature') == 'selections';
                    })(),
                ])

                @livewire('project-sidebar-link', [
                    'link' => '/approval-stages',
                    'icon' => 'fa fa-fw fa-thumbs-up',
                    'label' => 'Approvals',
                    'highlighted' => (function() {
                        return session('feature') == 'approvals';
                    })(),
                ])

                {{-- @livewire('project-sidebar-link', [
                    'link' => '/estimating',
                    'icon' => 'fa fa-fw fa-dollar',
                    'label' => 'Estimating',
                    'highlighted' => (function() {
                        return session('feature') == 'estimating';
                    })(),
                ])

                @livewire('project-sidebar-link', [
                    'link' => '/proposals',
                    'icon' => 'fa fa-fw fa-file-invoice',
                    'label' => 'Proposals',
                    'highlighted' => (function() {
                        return session('feature') == 'proposals';
                    })(),
                ])

                @livewire('project-sidebar-link', [
                    'link' => '/administration',
                    'icon' => 'fa fa-fw fa-users',
                    'label' => 'Administration',
                    'highlighted' => (function() {
                        return session('feature') == 'administration';
                    })(),
                ]) --}}
            </div>

            <div class="flex-none p-3">
                <div class="text-[11px] opacity-40 hover:opacity-100 transition ease-in-out">
                    <p><pre>roadmap: {{ json_encode(session('roadmap'), JSON_PRETTY_PRINT) }}</pre></p>
                    <p><pre>feature: {{ json_encode(session('feature'), JSON_PRETTY_PRINT) }}</pre></p>
                </div>
                <a href="https://github.com/Readyforeal/Clara" target="_blank" class="opacity-50 hover:opacity-100">Clara v{{ config('app.version') }}</a>
            </div>
        </div>
    </div>
</div>
