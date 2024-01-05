<div>
    <div class="flex justify-between mb-3">
        <div>
            @empty(!$selected)
            <x-secondary-button wire:click="setView('all')">
                <i class="fa fa-list-check"></i>
            </x-secondary-button>
            @endempty

            <x-input class="text-sm" type="text" name="search" wire:model.live.debounce.250ms="search"
            placeholder="Search {{
                $viewBy
            }}.." />

            <x-secondary-button wire:click="setView('all')">
                <i class="fa fa-table"></i>
            </x-secondary-button>
        
            <x-secondary-button wire:click="setView('categories')">
                <i class="fa fa-tag"></i>
            </x-secondary-button>
        
            <x-secondary-button wire:click="setView('locations')">
                <i class="fa fa-location-dot"></i>
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

    {{-- View all selections --}}
    @if ($viewBy == 'all')
        <x-table class="mt-1 transition ease-in-out" wire:loading.class="opacity-50">
            
            {{-- Table head --}}
            
            <x-slot name="head">
                <x-table.row>

                    {{-- <x-table.cell class="font-semibold w-10">
                        <x-checkbox wire:click="selectAll({{ $selections->pluck('id') }})"/> 
                    </x-table.cell> --}}

                    <x-table.cell class="font-semibold w-1/5">
                        <i class="fa fa-check-circle mr-2"></i>
                        Selection
                    </x-table.cell>

                    <x-table.cell class="font-semibold w-1/5">
                        <i class="fa fa-box mr-2"></i>
                        Items
                    </x-table.cell>

                    <x-table.cell class="font-semibold w-1/5">
                        <i class="fa fa-tag mr-2"></i>
                        Categories
                    </x-table.cell>

                    <x-table.cell class="font-semibold w-1/5">
                        <i class="fa fa-location-dot mr-2"></i>
                        Locations
                    </x-table.cell>

                    <x-table.cell class="font-semibold w-1/5">
                        <i class="fa fa-thumbs-up mr-2"></i>
                        Approval Status
                    </x-table.cell>
                </x-table.row>
            </x-slot>

            {{-- Table body --}}
            <x-slot name="body">
                @foreach ($selections as $selection)
                    <x-table.row class="{{ $this->getSelectionNeeded($selection->id) ? 'bg-red-100' : $this->getSelectionApprovalStatusColor($selection->id) }}">
                        {{-- <x-table.cell>
                            <x-checkbox wire:model.live="selected" :value="$selection->id" wire:loading.attr="disabled" />
                        </x-table.cell> --}}

                        <x-table.cell>
                            <x-checkbox wire:model.live="selected" :value="$selection->id" wire:loading.attr="disabled" />
                            <a class="ml-2" href="/selections/{{ $selection->id }}">{{ $selection->name }}</a>
                        </x-table.cell>

                        <x-table.cell>
                            @forelse($selection->items as $item)
                                @if(!$loop->first)
                                    ,
                                @endif
                                {{ $item->name }}
                            @empty
                                Selection needed
                            @endforelse
                        </x-table.cell>

                        <x-table.cell>
                            @forelse($selection->items->pluck('categories')->flatten()->unique('name') as $category)
                                <a href="/selection-lists/{{ $selectionListId }}?viewBy=categories&search={{ $category->name }}">{{ $category->name }}</a>
                            @empty
                                <span class="opacity-50">Uncategorized</span>
                            @endforelse
                        </x-table.cell>

                        <x-table.cell>
                            @foreach($selection->locations->flatten()->unique('name') as $location)
                                <a href="/selection-lists/{{ $selectionListId }}?viewBy=locations&search={{ $location->name }}">{{ $location->name }}</a>
                            @endforeach
                        </x-table.cell>

                        <x-table.cell>
                            @forelse ($selection->approvals as $approval)
                                <x-approval-badge :status="$approval->status">
                                    {{ $approval->approvalStage->name }}
                                </x-approval-badge>
                            @empty
                                <span class="opacity-50">No open approvals</span>
                            @endforelse
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    @endif

    {{-- View selections by category --}}

    @if ($viewBy == 'categories')
        @foreach ($categories as $category)
            <x-table class="mt-1 mb-2 transition ease-in-out" wire:loading.class="opacity-50">
                <x-slot name="caption">
                    <span class="font-semibold">{{ $category->name }}</span>
                </x-slot>

                {{-- Table head --}}

                @if (!$category->items->pluck('selections')->flatten()->where('selection_list_id', $selectionListId)->isEmpty())
                <x-slot name="head">
                    <x-table.row>

                        {{-- <x-table.cell class="font-semibold w-10">
                            <x-checkbox wire:model.live="categoriesSelected.{{ $category->id }}" wire:click="selectAllByCategory({{ $category->id }}, {{$category->items->pluck('selections')->flatten()->pluck('id') }})" />
                        </x-table.cell> --}}

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-check-circle mr-2"></i>
                            Selection
                        </x-table.cell>

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-box mr-2"></i>
                            Items
                        </x-table.cell>

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-tag mr-2"></i>
                            Categories
                        </x-table.cell>

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-location-dot mr-2"></i>
                            Locations
                        </x-table.cell>

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-check mr-2"></i>
                            Approval Status
                        </x-table.cell>
                    </x-table.row>
                </x-slot>
                @endif

                {{-- Table body --}}

                <x-slot name="body">
                    @foreach ($category->items as $item)
                        @foreach ($item->selections->where('selection_list_id', $selectionListId) as $selection)
                            <x-table.row class="{{ $this->getSelectionNeeded($selection->id) ? 'bg-red-100' : $this->getSelectionApprovalStatusColor($selection->id) }}">
                                {{-- <x-table.cell>
                                    <x-checkbox wire:model.live="selected" value="{{ $selection->id }}" wire:loading.attr="disabled" />
                                </x-table.cell> --}}
        
                                <x-table.cell>
                                    <x-checkbox wire:model.live="selected" :value="$selection->id" wire:loading.attr="disabled" />
                                    <a class="ml-2" href="/selections/{{ $selection->id }}">{{ $selection->name }}</a>
                                </x-table.cell>
        
                                <x-table.cell>
                                    @forelse($selection->items as $item)
                                        @if(!$loop->first)
                                            ,
                                        @endif
                                        {{ $item->name }}
                                    @empty
                                        Selection needed
                                    @endforelse
                                </x-table.cell>
        
                                <x-table.cell>
                                    @foreach($selection->items->pluck('categories')->flatten()->unique('name') as $category)
                                        <a href="/selection-lists/{{ $selectionListId }}?viewBy=categories&search={{ $category->name }}">{{ $category->name }}</a>
                                    @endforeach
                                </x-table.cell>
        
                                <x-table.cell>
                                    @foreach($selection->locations->flatten()->unique('name') as $location)
                                        <a href="/selection-lists/{{ $selectionListId }}?viewBy=locations&search={{ $location->name }}">{{ $location->name }}</a>
                                    @endforeach
                                </x-table.cell>

                                <x-table.cell>
                                    @forelse ($selection->approvals as $approval)
                                        <x-approval-badge :status="$approval->status">
                                            {{ $approval->approvalStage->name }}
                                        </x-approval-badge>
                                    @empty
                                        <span class="opacity-50">No open approvals</span>
                                    @endforelse
                                </x-table.cell>
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

    {{-- View selections by location --}}

    @if($viewBy == 'locations')
        @foreach ($locations as $location)
            <x-table class="mt-1 mb-2">
                <x-slot name="caption">
                    <span class="font-semibold">{{ $location->name }}</span>
                </x-slot>

                {{-- Table head --}}

                @if(!$location->selections->where('selection_list_id', $selectionListId)->isEmpty())
                <x-slot name="head">
                    <x-table.row>

                        {{-- <x-table.cell class="font-semibold w-10">
                            <x-checkbox />
                        </x-table.cell> --}}

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-check-circle mr-2"></i>
                            Selection
                        </x-table.cell>

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-box mr-2"></i>
                            Items
                        </x-table.cell>

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-tag mr-2"></i>
                            Categories
                        </x-table.cell>

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-location-dot mr-2"></i>
                            Locations
                        </x-table.cell>

                        <x-table.cell class="font-semibold w-1/5">
                            <i class="fa fa-check mr-2"></i>
                            Approval Status
                        </x-table.cell>
                    </x-table.row>
                </x-slot>
                @endif

                {{-- Table body --}}

                <x-slot name="body">
                    @forelse ($location->selections->where('selection_list_id', $selectionListId) as $selection)
                        <x-table.row class="{{ $this->getSelectionNeeded($selection->id) ? 'bg-red-100' : $this->getSelectionApprovalStatusColor($selection->id) }}">
                            {{-- <x-table.cell>
                                <x-checkbox />
                            </x-table.cell> --}}

                            <x-table.cell>
                                <x-checkbox wire:model.live="selected" :value="$selection->id" wire:loading.attr="disabled" />
                                <a class="ml-2" href="/selections/{{ $selection->id }}">{{ $selection->name }}</a>
                            </x-table.cell>

                            <x-table.cell>
                                @forelse($selection->items as $item)
                                    @if(!$loop->first)
                                        ,
                                    @endif
                                    {{ $item->name }}
                                @empty
                                    Selection needed
                                @endforelse
                            </x-table.cell>

                            <x-table.cell>
                                @foreach($selection->items->pluck('categories')->flatten()->unique('name') as $category)
                                    <a href="/selection-lists/{{ $selectionListId }}?viewBy=categories&search={{ $category->name }}">{{ $category->name }}</a>
                                @endforeach
                            </x-table.cell>

                            <x-table.cell>
                                @foreach($selection->locations->flatten()->unique('name') as $location)
                                    <a href="/selection-lists/{{ $selectionListId }}?viewBy=locations&search={{ $location->name }}">{{ $location->name }}</a>
                                @endforeach
                            </x-table.cell>

                            <x-table.cell>
                                @forelse ($selection->approvals as $approval)
                                    <x-approval-badge :status="$approval->status">
                                        {{ $approval->approvalStage->name }}
                                    </x-approval-badge>
                                @empty
                                    <span class="opacity-50">No open approvals</span>
                                @endforelse
                            </x-table.cell>
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
