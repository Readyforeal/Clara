<div>
    <x-input type="text" name="search" wire:model.live="search" />
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
</div>
