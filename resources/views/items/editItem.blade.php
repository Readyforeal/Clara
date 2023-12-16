<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold mb-3">Edit Item</p>

                <p class="text-xs mb-3">Fields marked with * are required</p>

                {{-- Make form into component --}}
                <form action="/item/{{ $item->id }}/edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <p class="font-semibold">Item Info</p>

                    <div class="mt-2">
                        <x-label for="name" value="{{ __('Name *') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$item->name" required />
                    </div>

                    <div class="mt-2">
                        <x-label for="item_number" value="{{ __('Item Number') }}" />
                        <x-input id="item_number" class="block mt-1 w-full" type="text" name="item_number" :value="$item->item_number" />
                    </div>

                    <div class="mt-2">
                        <x-label for="supplier" value="{{ __('Supplier') }}" />
                        <x-input id="supplier" class="block mt-1 w-full" type="text" name="supplier" :value="$item->supplier" />
                    </div>

                    <div class="mt-2">
                        <x-label for="link" value="{{ __('Link') }}" />
                        <x-input id="link" class="block mt-1 w-full" type="text" name="link" :value="$item->link" />
                    </div>

                    <div class="mt-2">
                        <x-label for="image" value="{{ __('Image') }}" />
                        <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="$item->image" />
                    </div>

                    <div class="mt-2">
                        <x-label for="dimensions" value="{{ __('Dimensions') }}" />
                        <x-input id="dimensions" class="block mt-1 w-full" type="text" name="dimensions" :value="$item->dimensions" />
                    </div>

                    <div class="mt-2">
                        <x-label for="color" value="{{ __('Color') }}" />
                        <x-input id="color" class="block mt-1 w-full" type="text" name="color" :value="$item->color" />
                    </div>

                    <div class="mt-2">
                        <x-label for="notes" value="{{ __('Notes') }}" />
                        <x-input id="notes" class="block mt-1 w-full" type="text" name="notes" :value="$item->notes" />
                    </div>

                    <x-button class="mt-2">Update</x-button>
                    
                </form>

                <form class="mt-3" action="/item/{{ $item->id }}/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button>Delete</x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>