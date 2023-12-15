<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-3">
                <p class="font-semibold mb-3">Create Selection</p>

                <p class="text-xs mb-3">Fields marked with * are required</p>

                <form action="/selection/create" method="POST" enctype="multipart/form-data">
                    @csrf

                    <p class="font-semibold">Selection Info</p>

                    <div class="mt-2">
                        <x-label for="name" value="{{ __('Name *') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-2">
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />
                    </div>

                    <div class="mt-2">
                        <x-label for="quantity" value="{{ __('Quantity') }}" />
                        <x-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')" />
                    </div>

                    <p class="mt-6 font-semibold">Selection Item Info</p>

                    <div class="mt-2">
                        <x-label for="item_name" value="{{ __('Item Name *') }}" />
                        <x-input id="item_name" class="block mt-1 w-full" type="text" name="item_name" :value="old('item_name')" />
                    </div>

                    <div class="mt-2">
                        <x-label for="item_number" value="{{ __('Item Number') }}" />
                        <x-input id="item_number" class="block mt-1 w-full" type="text" name="item_number" :value="old('item_number')" />
                    </div>

                    <div class="mt-2">
                        <x-label for="supplier" value="{{ __('Supplier') }}" />
                        <x-input id="supplier" class="block mt-1 w-full" type="text" name="supplier" :value="old('supplier')" />
                    </div>

                    <div class="mt-2">
                        <x-label for="link" value="{{ __('Link') }}" />
                        <x-input id="link" class="block mt-1 w-full" type="text" name="link" :value="old('link')" />
                    </div>

                    <div class="mt-2">
                        <x-label for="image" value="{{ __('Image') }}" />
                        <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" />
                    </div>

                    <div class="mt-2">
                        <div class="flex">
                            <div>
                                <x-label for="length" value="{{ __('Length') }}" />
                                <x-input id="length" class="block mt-1 w-full" type="number" name="length" :value="old('length')" />
                            </div>

                            <div class="ml-2">
                                <x-label for="length_unit" value="{{ __('Unit') }}" />
                                <x-select id="length_unit" class="block mt-1 w-full" name="length_unit">
                                    <option disabled selected>Select</option>
                                    <option value="in">In</option>
                                    <option value="ft">Ft</option>
                                    <option value="yds">Yds</option>
                                </x-select>
                            </div>

                        </div>
                        
                        <div class="flex mt-2">
                            <div>
                                <x-label for="width" value="{{ __('Width') }}" />
                                <x-input id="width" class="block mt-1 w-full" type="number" name="width" :value="old('width')" />
                            </div>

                            <div class="ml-2">
                                <x-label for="width_unit" value="{{ __('Unit') }}" />
                                <x-select id="width_unit" class="block mt-1 w-full" name="width_unit">
                                    <option disabled selected>Select</option>
                                    <option value="in">In</option>
                                    <option value="ft">Ft</option>
                                    <option value="yds">Yds</option>
                                </x-select>
                            </div>
                        </div>
                        
                        <div class="flex mt-2">
                            <div>
                                <x-label for="height" value="{{ __('Height') }}" />
                                <x-input id="height" class="block mt-1 w-full" type="number" name="height" :value="old('height')" />
                            </div>

                            <div class="ml-2">
                                <x-label for="height_unit" value="{{ __('Unit') }}" />
                                <x-select id="height_unit" class="block mt-1 w-full" name="height_unit">
                                    <option disabled selected>Select</option>
                                    <option value="in">In</option>
                                    <option value="ft">Ft</option>
                                    <option value="yds">Yds</option>
                                </x-select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <x-label for="color" value="{{ __('Color') }}" />
                        <x-input id="color" class="block mt-1 w-full" type="text" name="color" :value="old('color')" />
                    </div>

                    <div class="mt-2">
                        <x-label for="notes" value="{{ __('Notes') }}" />
                        <x-input id="notes" class="block mt-1 w-full" type="text" name="notes" :value="old('notes')" />
                    </div>

                    <x-button class="mt-2">Create</x-button>
                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>