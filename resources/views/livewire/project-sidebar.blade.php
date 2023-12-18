<div class="fixed w-[300px] top-14 bottom-0">
    <div class="w-full h-full bg-white border-r border-gray-300">
        <div class="p-6">
            {{-- Project information --}}
            <p class="text-xl font-semibold">{{ $project->name }}</p>
            <p class="text-xs">{{ $project->street }}</p>
            <p class="text-xs">{{ $project->city }}, {{ $project->state }} {{ $project->zip }}</p>
            <p>{{ $project->description }}</p>

            {{-- Navigation --}}
            <div class="mt-3">
                @livewire('project-sidebar-link', [
                    'link' => '/project/' . $project->id,
                    'icon' => '',
                    'label' => 'Home',
                    'highlighted' => (function() {
                        return request()->routeIs('project.show');
                    })(),
                ])

                @livewire('project-sidebar-link', [
                    'link' => '/selections',
                    'icon' => '',
                    'label' => 'Selections',
                    'highlighted' => (function() {
                        return request()->routeIs('selectionList.index');
                    })(),
                ])
            </div>
        </div>
    </div>
</div>
