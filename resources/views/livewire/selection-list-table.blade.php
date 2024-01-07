<div>
    <div class="flex justify-between mb-3">
        <div>
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

            @empty(!$selected)
            <div class="inline-block">
                <x-secondary-button-link icon="list-check" class="text-xs" wire:click.prevent="$toggle('showBulkActions')">
                    Bulk Actions
                </x-secondary-button-link>

                @if($showBulkActions)
                    <div wire:transition class="p-2 absolute mt-2 bg-gray-50 border border-white rounded-xl shadow-xl">
                        <x-secondary-button wire:click="$toggle('showStagingModal')">Stage for Approval</x-secondary-button>
                        <x-secondary-button wire:click="$toggle('showDeleteModal')">Delete</x-secondary-button>
                    </div>
                @endif
            </div>
            @endempty

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
        <x-table class="mt-1 transition ease-in-out" >
            
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
                                <span class="opacity-50">Unstaged</span>
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
            <x-table class="mt-1 mb-2 transition ease-in-out" >
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
                            <i class="fa fa-thumbs-up mr-2"></i>
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
                                        <span class="opacity-50">Unstaged</span>
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
            <x-table class="mt-1 mb-2" >
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
                            <i class="fa fa-thumbs-up mr-2"></i>
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
                                    <span class="opacity-50">Unstaged</span>
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

    {{-- Modals --}}
    @if ($showStagingModal)
        <div wire:transition.opacity class="fixed top-0 left-0 right-0 justify-center items-center w-full h-screen bg-gray-100/70 backdrop-blur-sm">
            <x-card class="relative mt-6 max-w-2xl mx-auto shadow-xl">
                <x-slot name="head">
                    <p>Stage Selections</p>
                </x-slot>

                <x-slot name="body">
                    <p>Select an approval stage</p>
                    <x-select class="mt-1 w-full" wire:model.live="approvalStageId">
                        <option hidden>Select stage</option>
                        @foreach ($project->approvalStages as $approvalStage)
                            <option value="{{ $approvalStage->id }}">{{ $approvalStage->name }}</option>
                        @endforeach
                    </x-select>
                </x-slot>

                <x-slot name="foot">
                    <x-secondary-button icon="xmark" wire:click="$toggle('showStagingModal')">
                        Cancel
                    </x-secondary-button>

                    @if ($approvalStageId)
                    <x-button wire:transition icon="check" wire:click.prevent="stageSelected">
                        Stage Selections
                    </x-button>
                    @endif
                </x-slot>
            </x-card>
        </div>
    @endif

    @if ($showDeleteModal)
        <div wire:transition.opacity class="fixed top-0 left-0 right-0 justify-center items-center w-full h-screen bg-gray-100/70 backdrop-blur-sm">
            <x-card class="relative mt-6 max-w-2xl mx-auto shadow-xl">
                <x-slot name="head">
                    <p>Delete Selections</p>
                </x-slot>

                <x-slot name="body">
                   <p>Are you sure you would like to delete these selections?</p>
                </x-slot>

                <x-slot name="foot">
                    <x-secondary-button icon="xmark" wire:click="$toggle('showStagingModal')">
                        Cancel
                    </x-secondary-button>

                    <x-button wire:transition icon="trash" wire:click.prevent="deleteSelected">
                        Delete
                    </x-button>
                </x-slot>
            </x-card>
        </div>
    @endif
</div>
