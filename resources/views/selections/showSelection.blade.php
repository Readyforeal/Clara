<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold">{{ $selection->name }}</p>
                <p class="text-xs mb-3">{{ $selection->created_at }}</p>

                @foreach ($selection->locations as $location)
                    <p class="mb-3">{{ $location->name }}</p>
                @endforeach

                    <a class="my-2 opacity-50 hover:opacity-100" href="/item/create">Create Item</a>
                
                @foreach ($selection->items as $item)
                    <div class="border p-3">
                        
                        @foreach ($item->categories as $category)
                            <p>{{ $category->name }}</p>
                        @endforeach

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