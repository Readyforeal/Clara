<x-project-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Selection
        </h2>
    </x-slot>

    <div class="px-6">
        {{-- Action zone --}}
        <div class="flex justify-between">

        </div>

        {{-- Content --}}
        <x-card>
            <x-slot name="body">
                <div class="grid grid-cols-3">
                    {{-- Left Panel --}}
                    <div class="col-span-2 pr-3">
                        <div>
                            <p class="font-semibold text-xl">{{ $selection->name }}</p>
                            <p>{{ $selection->description }}</p>
                        </div>

                        <div class="pt-2">
                            <x-secondary-button-link icon="pen" url="/selections/{{ $selection->id }}/edit">Edit Selection</x-button-link>
                            <x-button-link icon="add" url="/items/create">Add Item</x-button-link>
                        </div>

                        @if ($selection->items->count() > 1)
                            <p class="mt-3"><i class="fa fa-circle-exclamation mr-2"></i>This selection contains multiple options. Please select.</p>
                        @endif

                        @foreach($selection->items as $item)
                            <div class="p-3 mt-3 border border-white shadow hover:border-gray-300 rounded-xl transition ease-in-out group">
            
                                {{-- Item Name and Link --}}
                                <div class="flex justify-between">
                                    <div>
                                        <p class="text-xs font-semibold">Item Name</p>
                                        <a href="{{ isset($item->link) ? $item->link : '' }}" target="_blank" class="text-xl">{{ $item->name }}</a>
                                    </div>
                                    <div class="opacity-0 group-hover:opacity-100 transition ease-in-out">
                                        <x-secondary-button-link url="/items/{{ $item->id }}/edit" icon="pen" />
                                        <x-secondary-button-link icon="copy" />
                                        <x-secondary-button-link icon="trash" />
                                    </div>
                                </div>
            
                                {{-- Item Number --}}
                                <div class="mt-2">
                                    <p class="text-xs font-semibold">Item Number</p>
                                    @if(isset($item->item_number))
                                        <p>#{{ $item->item_number }}</p>
                                    @else
                                        <p>No item number</p>
                                    @endif
                                </div>
            
                                {{-- Supplier --}}
                                <div class="mt-2">
                                    <p class="text-xs font-semibold">Supplier</p>
                                @if(isset($item->supplier))
                                    <p>{{ $item->supplier }}</p>
                                @else
                                    <p>No supplier</p>
                                @endif
                                </div>
            
                                {{-- Dimensions --}}
                                <div class="mt-2">
                                    <p class="text-xs font-semibold">Dimensions</p>
                                    @if(isset($item->dimensions))
                                        <p>{{ $item->dimensions }}</p>
                                    @else
                                        <p>No dimensions</p>
                                    @endif
                                </div>
            
                                {{-- Color --}}
                                <div class="mt-2">
                                    <p class="text-xs font-semibold">Color</p>
                                    @if(isset($item->color))
                                        <p>{{ $item->color }}</p>
                                    @else
                                        <p>No color</p>
                                    @endif
                                </div>
                            </div>
        
                        @endforeach
                    </div>

                    {{-- Right Panel --}}
                    <div class="col-span-1">
                        <x-card class="mb-3">

                            <x-slot name="head">
                                <p class="font-semibold mt-1">Approvals</p>
                                <x-button icon="list-check">Stage for Approval</x-button>
                            </x-slot>

                            <x-slot name="body">
                                @forelse ($selection->approvals as $approval)
                                    <x-card class="mt-2 {{ ($approval->status == 'Pending') ? 'bg-yellow-100' : (($approval->status == 'Approved') ? 'bg-green-100' : 'bg-red-100') }}">
                                        <x-slot name="head">
                                            <p class="mt-1">{{ $approval->approvalStage->name }}</p>
                                            <form action="/selections/approvals/{{ $approval->id }}/delete" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-button class="p-1" icon="trash" />
                                            </form>
                                        </x-slot>
    
                                        <x-slot name="body">
                                            <div class="flex justify-between">
                                                <p class="mt-1 font-semibold">{{ $approval->status }}</p>
                                                <div class="flex space-x-1">
                                                    <form action="/approvals/{{ $approval->id }}/update-approval-status" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <x-input type="hidden" name="approval_id" value="{{ $approval->id }}" />
                                                        <x-input type="hidden" name="status" value="Approved" />
                                                        <x-button icon="thumbs-up" color="green" />
                                                    </form>
                                                    <form action="/approvals/{{ $approval->id }}/update-approval-status" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <x-input type="hidden" name="approval_id" value="{{ $approval->id }}" />
                                                        <x-input type="hidden" name="status" value="Pending" />
                                                        <x-button icon="hourglass" color="yellow" />
                                                    </form>
                                                    <form action="/approvals/{{ $approval->id }}/update-approval-status" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <x-input type="hidden" name="approval_id" value="{{ $approval->id }}" />
                                                        <x-input type="hidden" name="status" value="Denied" />
                                                        <x-button icon="thumbs-down" color="red" />
                                                    </form>
                                                </div>
                                            </div>
                                        </x-slot>
                                    </x-card>
                                @empty
                                    <p class="text-xs">No approvals open</p>
                                @endforelse
                            </x-slot>
                        </x-card>

                        <x-card class="mb-3">
                            <x-slot name="head">
                                <p class="font-semibold mt-1">Locations</p>
                                <x-button icon="location-pin">Locate</x-button>
                            </x-slot>

                            <x-slot name="body">
                                @foreach ($selection->locations as $location)
                                    <div class="inline-flex py-1 px-2 text-xs bg-blue-100 border border-blue-600 text-blue-600 rounded-xl">
                                        <span class="font-semibold">{{ $location->name }}</span>
                                    </div>
                                @endforeach
                            </x-slot>
                        </x-card>
                    </div>
                </div>
            </x-slot>

            <x-slot name="foot">
                <p class="text-xs">Created: @datetime($selection->created_at)</p>
                <p class="text-xs">Updated: {{ $selection->updated_at }}</p>
            </x-slot>
        </x-card>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                
                {{-- Approvals DEV NOTE: Make into component --}}
                <form action="/selections/approvals/create" method="POST" class="mb-3">
                    @csrf
                    
                    <x-input type="hidden" name="selection_id" :value="$selection->id" />
                    
                    <div class="mt-2">
                        <x-label for="approval_stage_id" value="{{ __('Approval Stage *') }}" />
                        <x-select class="mt-1" name="approval_stage_id">
                            @foreach ($project->approvalStages as $approvalStage)
                                <option value="{{ $approvalStage->id }}">{{ $approvalStage->name }}</option>
                            @endforeach
                        </x-select>
                    </div>

                    <x-button class="mt-2" icon="list-check">Stage for Approval</x-button>
                </form>

                @foreach ($selection->approvals as $approval)
                    <div class="flex justify-between mb-3 border rounded-md p-3">
                        <div>
                            <p class="text-xs">Approval Stage: {{ $approval->approvalStage->name }}</p>
                            <p class="text-xs">Status: {{ $approval->status }}</p>
                        </div>

                        <div class="flex space-x-1">
                            <form action="/approvals/{{ $approval->id }}/update-approval-status" method="POST">
                                @csrf
                                @method('PATCH')
                                <x-input type="hidden" name="approval_id" value="{{ $approval->id }}" />
                                <x-input type="hidden" name="status" value="Approved" />
                                <x-button icon="thumbs-up" color="green">Approve</x-button>
                            </form>
                            <form action="/approvals/{{ $approval->id }}/update-approval-status" method="POST">
                                @csrf
                                @method('PATCH')
                                <x-input type="hidden" name="approval_id" value="{{ $approval->id }}" />
                                <x-input type="hidden" name="status" value="Pending" />
                                <x-button icon="hourglass" color="yellow">Pending</x-button>
                            </form>
                            <form action="/approvals/{{ $approval->id }}/update-approval-status" method="POST">
                                @csrf
                                @method('PATCH')
                                <x-input type="hidden" name="approval_id" value="{{ $approval->id }}" />
                                <x-input type="hidden" name="status" value="Denied" />
                                <x-button icon="thumbs-down" color="red">Deny</x-button>
                            </form>
                            <form action="/selections/approvals/{{ $approval->id }}/delete" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-button icon="trash">Delete</x-button>
                            </form>
                        </div>
                    </div>
                @endforeach

                {{-- Selection Info --}}
                <a class="inline-flex mb-3 opacity-50 hover:opacity-100" href="/selections/{{ $selection->id }}/edit">Edit</a>

                <p class="font-semibold">{{ $selection->name }}</p>
                <p class="text-xs">{{ $selection->created_at }}</p>

                <p class="text-xs font-semibold mt-3 text-purple-600">Locations</p>
                @forelse ($selection->locations as $location)
                <p>{{ $location->name }}</p>
                @empty
                <p>This selection has not been located</p>
                @endforelse

                <a class="inline-flex mt-3 opacity-50 hover:opacity-100" href="/items/create">Add Item</a>

                @if ($selection->items->count() > 1)
                <p class="mt-3">This selection contains multiple options. Please select.</p>
                @endif
                
                {{-- Items --}}
                @foreach ($selection->items as $item)
                <div class="border mt-3 p-3">

                    @if ($selection->items->count() > 1)
                    <p>
                        <i class="fa fa-fw fa-{{ $item->pivot->selected ? 'check' : 'multiply' }}"></i>
                        {{ $item->pivot->selected ? 'Selected' : 'Not Selected' }}
                    </p>
                    @endif

                    <a class="inline-flex mb-3 opacity-50 hover:opacity-100" href="/items/{{ $item->id }}/edit">Edit</a>
                    
                    <p class="text-xs font-semibold text-blue-600">Categories</p>
                    @forelse ($item->categories as $category)
                    <p>{{ $category->name }}</p>
                    @empty
                    <p>This selection has not been categorized</p>
                    @endforelse

                    <div class="my-3">
                        <p class="text-xs font-semibold">Item Name</p>
                        <p>{{ $item->name }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-xs font-semibold">Supplier</p>
                        <p>{{ $item->supplier }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-xs font-semibold">Item Number</p>
                        <p>{{ $item->item_number }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-xs font-semibold">Link</p>
                        <p>{{ $item->link }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-xs font-semibold">Dimensions</p>
                        <p>{{ $item->dimensions }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-xs font-semibold">Color</p>
                        <p>{{ $item->color }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="text-xs font-semibold">Notes</p>
                        <p>{{ $item->notes }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-project-layout>