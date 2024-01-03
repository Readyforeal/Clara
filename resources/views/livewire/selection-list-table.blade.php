<div>
    <div class="flex justify-between">
        <div>
            <x-input class="mb-2 text-sm" type="text" name="search" placeholder="Search.." wire:model.live="search" />

            <x-secondary-button wire:click="$set('viewBy', 'all')">
                <i class="fa fa-table"></i>
            </x-secondary-button>
        
            <x-secondary-button wire:click="$set('viewBy', 'categories')">
                <i class="fa fa-tag"></i>
            </x-secondary-button>
        
            <x-secondary-button wire:click="$set('viewBy', 'locations')">
                <i class="fa fa-location"></i>
            </x-secondary-button>

            @if ($viewBy == 'categories')
                <x-secondary-button-link icon="tag">
                    Manage Project Categories
                </x-secondary-button-link>
            @endif
        </div>

        <div>
            <x-button-link icon="plus" url="/selections/create">Create Selection</x-button-link>
        </div>
    </div>

    @if ($viewBy == 'all')
        <x-table class="mt-1">
            <x-slot name="head">
                <x-table.row>
                    <x-table.cell class="font-semibold w-1/6"><i class="fa fa-check mr-2"></i>Selection</x-table.cell>
                    <x-table.cell class="font-semibold w-1/6"><i class="fa fa-box mr-2"></i>Item(s)</x-table.cell>
                    <x-table.cell class="font-semibold w-1/6"><i class="fa fa-tag mr-2"></i>Categories</x-table.cell>
                    <x-table.cell class="font-semibold"><i class="fa fa-location mr-2"></i>Locations</x-table.cell>
                </x-table.row>
            </x-slot>

            <x-slot name="body">
                @foreach ($selections as $selection)
                    <x-table.row>
                        <x-table.cell>
                            {{ $selection->name }}
                        </x-table.cell>

                        <x-table.cell>
                            @forelse($selection->items as $item)
                                {{ $item->name }},
                            @empty
                                Selection needed
                            @endforelse
                        </x-table.cell>

                        <x-table.cell>
                            @foreach($selection->items->pluck('categories')->flatten()->unique('name') as $category)
                                {{ $category->name }}
                            @endforeach
                        </x-table.cell>

                        <x-table.cell>
                            @foreach($selection->locations->flatten()->unique('name') as $location)
                                {{ $location->name }}
                            @endforeach
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    @endif

    @if ($viewBy == 'categories')
        @foreach ($categories as $category)
            <x-table class="mt-1 mb-2">
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
                                <x-table.cell>{{ $item->name }}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    @endforeach

                    @if ($category->items->pluck('selections')->flatten()->where('selection_list_id', $selectionListId)->isEmpty())
                        <x-table.row>
                            <x-table.cell>No selections</x-table.cell>
                        </x-table.row>
                    @endif
                </x-slot>
            </x-table>
        @endforeach
    @endif

    @if($viewBy == 'locations')
        @foreach ($locations as $location)
            <x-table>
                <x-slot name="head">
                    <x-table.row>
                        <x-table.cell class="font-semibold">{{ $location->name }}</x-table.cell>
                    </x-table.row>
                </x-slot>

                <x-slot name="body">
                    @forelse ($location->selections->where('selection_list_id', $selectionListId) as $selection)
                        <x-table.row>
                            <x-table.cell>{{ $selection->name }}</x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell>No selections</x-table.cell>
                        </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        @endforeach
    @endif
</div>
