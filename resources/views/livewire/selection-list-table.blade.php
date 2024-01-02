<div>
    <x-input class="mb-2" type="text" name="search" placeholder="Search.." wire:model.lazy="search" />

    <x-button wire:click="$set('viewBy', 'all')">View all</x-button>
    <x-button wire:click="$set('viewBy', 'categories')">View by categories</x-button>
    <x-button wire:click="$set('viewBy', 'locations')">View by locations</x-button>

    <p>{{ $viewBy }}</p>

    @if ($viewBy == 'all')
        <x-table>
            <x-slot name="head">
                <x-table.row>
                    <x-table.cell class="font-semibold">Selection</x-table.cell>
                </x-table.row>
            </x-slot>

            <x-slot name="body">
                @foreach ($selections as $selection)
                    <x-table.row>
                        <x-table.cell>{{ $selection->name }}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    @endif

    @if ($viewBy == 'categories')
        @foreach ($project->categories->sortBy('name') as $category)    
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.cell class="font-semibold">{{ $category->name }}</x-table.cell>
                    </x-table.row>
                </x-slot>

                <x-slot name="body">
                    @foreach ($category->items as $item)
                        @foreach ($item->selections->where('selection_list_id', $selectionListId) as $selection)
                            <x-table.row>
                                <x-table.cell>{{ $selection->name }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    @endforeach
                </x-slot>
            </x-table>
        @endforeach
    @endif

    @if($viewBy == 'locations')
        @foreach ($project->locations as $location)
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.cell class="font-semibold">{{ $location->name }}</x-table.cell>
                    </x-table.row>
                </x-slot>

                <x-slot name="body">
                    @foreach ($location->selections->where('selection_list_id', $selectionListId) as $selection)
                        <x-table.row>
                            <x-table.cell>{{ $selection->name }}</x-table.cell>
                        </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
        @endforeach
    @endif
</div>
