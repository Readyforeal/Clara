<div class="fixed w-[300px] top-14 bottom-0">
    <div class="w-full h-full bg-white border-r border-gray-300">
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
                        return request()->routeIs('selectionList.index');
                    })(),
                ])
            </div>

            <div class="flex-none p-6">
                <p class="opacity-50">Clara v{{ config('app.version') }}</p>
            </div>
        </div>
    </div>
</div>
