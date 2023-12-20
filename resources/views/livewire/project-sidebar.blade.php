<div class="fixed w-[300px] top-14 bottom-0">
    <div class="w-full h-full bg-gray-100 text-black border-r border-gray-300">
        <div class="h-full flex flex-col">
            {{-- Project information --}}
            <div class="px-6 mt-6">
                <p class="text-xl font-semibold">{{ $project->name }}</p>
                <p class="text-xs">{{ $project->street }}</p>
                <p class="text-xs">{{ $project->city }}, {{ $project->state }} {{ $project->zip }}</p>
                <p>{{ $project->description }}</p>
            </div>

            {{-- Navigation --}}
            <div class="flex-grow p-6">
                @livewire('project-sidebar-link', [
                    'link' => '/project/' . $project->id,
                    'icon' => 'fa fa-fw fa-home',
                    'label' => 'Home',
                    'highlighted' => (function() {
                        return request()->routeIs('project.show');
                    })(),
                ])

                @livewire('project-sidebar-link', [
                    'link' => '/selections',
                    'icon' => 'fa fa-fw fa-check-circle',
                    'label' => 'Selections',
                    'highlighted' => (function() {
                        return session('feature') == 'selections';
                    })(),
                ])

                @livewire('project-sidebar-link', [
                    'link' => '/approvals',
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

            <div class="flex-none p-6">
                <a href="https://github.com/Readyforeal/Clara" target="_blank" class="opacity-50 hover:opacity-100">Clara v{{ config('app.version') }}</a>
            </div>
        </div>
    </div>
</div>
