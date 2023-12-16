<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">

                <a class="inline-flex mb-3 opacity-50 hover:opacity-100" href="/selection/{{ $selection->id }}/edit">Edit</a>

                <p class="font-semibold">{{ $selection->name }}</p>
                <p class="text-xs">{{ $selection->created_at }}</p>

                <p class="text-xs font-semibold mt-3 text-purple-600">Locations</p>
                @forelse ($selection->locations as $location)
                <p>{{ $location->name }}</p>
                @empty
                <p>This selection has not been located</p>
                @endforelse

                <a class="inline-flex mt-3 opacity-50 hover:opacity-100" href="/item/create">Add Item</a>

                @if ($selection->items->count() > 1)
                <p class="mt-3">This selection contains multiple options. Please select.</p>
                @endif
                
                @foreach ($selection->items as $item)
                <div class="border mt-3 p-3">

                    <a class="inline-flex mb-3 opacity-50 hover:opacity-100" href="/item/{{ $item->id }}/edit">Edit</a>
                    
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
</x-app-layout>