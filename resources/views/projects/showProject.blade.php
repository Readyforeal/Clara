<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">

                <div class="border p-3 mb-3">
                    <p class="font-semibold">Project Info</p>
                    <p>{{ $project->name }}</p>
                    <p>{{ $project->street }}, {{ $project->city }} {{ $project->state }} {{ $project->zip }}</p>
                    <p>{{ $project->description }}</p>
                </div>

                <div class="grid grid-cols-2 space-x-3 mb-3">
                    <div class="border p-3">
                        <p class="font-semibold">Categories</p>
                        @foreach (auth()->user()->currentTeam->categories as $category)
                            <p>{{ $category->name }}</p>
                        @endforeach
                    </div>

                    <div class="border p-3">
                        <p class="font-semibold">Project Categories</p>
                        @foreach ($project->categories as $category)
                            <p>{{ $category->name }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="border p-3 mb-3">
                    <p class="font-semibold">Locations</p>
                    @foreach ($project->locations as $location)
                        <p>{{ $location->name }}</p>
                    @endforeach
                </div>

                <div class="border p-3 mb-3">
                    <p class="font-semibold">Selection Lists</p>
                    @foreach ($project->selectionLists as $selectionList)
                        <p>{{ $selectionList->name }}</p>
                        
                        <ul class="pl-6 list-disc">
                        @foreach ($selectionList->selections as $selection)
                            <li class="text-xs">
                                {{ $selection->name }}
                                @foreach ($selection->locations as $location)
                                    <span class="p-1 mr-1 bg-purple-100 text-purple-600 font-semibold">{{ $location->name }}</span>
                                @endforeach
                                @foreach ($selection->items as $item)
                                    <p class="font-semibold text-red-600">{{ $item->name }}</p>
                                @endforeach
                            </li>
                        @endforeach
                        </ul>
                    @endforeach
                </div>

                <div class="border p-3 mb-3">
                    <p class="font-semibold">Items</p>
                    @foreach (auth()->user()->currentTeam->items as $item)
                    <div class="p-2">
                        <p>{{ $item->name }}</p>
                        <p class="text-xs">
                            {{ $item->item_number }},
                            {{ $item->supplier }},
                            {{ $item->link == '' ? '' : 'Link' }}
                            {{ $item->dimensions }},
                            {{ $item->color }},
                            {{ $item->notes }}
                            @foreach ($item->categories as $category)
                                <span class="p-1 mr-1 bg-blue-100 text-blue-600 font-semibold">{{ $category->name }}</span>
                            @endforeach
                        </p>
                    </div>
                    @endforeach
                </div>

                <div class="border p-3 mb-3">
                    <p class="font-semibold">All Selections in Selection List</p>
                    @foreach (\App\Models\SelectionList::findOrFail(1)->selections as $selection)
                        <p>{{ $selection->name }}, {{ $selection->items->count() . ' Items' }}</p>
                    @endforeach
                </div>

                <div class="border p-3 mb-3">
                    <p class="font-semibold">
                        {{ \App\Models\SelectionList::findOrFail(1)->name . ': ' }}
                        Selections by Category
                    </p>
                    @foreach ($project->categories as $category)
                        <p>{{ $category->name }}</p>
                        @foreach ($category->items as $item)
                            <ul class="pl-6 list-disc">
                            @foreach ($item->selections->where('selection_list_id', 1) as $selection)
                                <li class="text-xs">{{ $selection->name }}</li>
                            @endforeach
                            </ul>
                        @endforeach
                    @endforeach

                    <p class="py-2 font-semibold">Excluded Categories with Selections</p>
                    @foreach (\App\Models\Selection::where('selection_list_id', 1)->get() as $selection)
                        @foreach ($selection->items as $item)
                            @foreach ($item->categories as $category)
                                @if(!$project->categories->contains('id', $category->id) )
                                    <p>
                                        {{ $selection->name }}
                                        @foreach ($item->categories as $excludedCategory)
                                            <span class="p-1 mr-1 bg-blue-100 text-blue-600 font-semibold">{{ $excludedCategory->name }}</span>
                                        @endforeach
                                    </p>
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach

                    <p class="py-2 font-semibold">Uncategorized</p>
                    @foreach (\App\Models\Selection::where('selection_list_id', 1)->get() as $selection)
                        @foreach ($selection->items as $item)
                            @if($item->categories->isEmpty())
                                <p>{{ $selection->name }}</p>
                            @endif
                        @endforeach
                    @endforeach
                </div>

                <div class="border p-3 mb-3">
                    <p class="font-semibold">
                        {{ \App\Models\SelectionList::findOrFail(1)->name . ': ' }}
                        Selections by Location
                    </p>
                    @foreach ($project->locations as $location)
                        <p>{{ $location->name }}</p>
                        <ul class="pl-6 list-disc">
                        @foreach ($location->selections->where('selection_list_id', 1) as $selection)
                            <li class="text-xs">{{ $selection->name }}</li>
                        @endforeach
                        </ul>
                    @endforeach

                    <p class="py-3 font-semibold">Non-Located Selections</p>
                    @foreach (\App\Models\Selection::where('selection_list_id', 1)->get() as $selection)
                        @if($selection->locations->isEmpty())
                            <p>{{ $selection->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
