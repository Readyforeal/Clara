<a href="{{ $link }}" class="flex w-full py-2 text-left rounded-md group cursor-pointer {{ $highlighted ? 'opacity-100' : 'opacity-50' }} hover:opacity-100 hover:bg-blue-500/20 transition ease-in-out">
    <span class="flex group-hover:translate-x-3 transition ease-in-out {{ $highlighted ? 'text-blue-500' : '' }}">
        <i class="{{ $icon }} mt-1 mr-3 group-hover:text-blue-500 transition ease-in-out"></i>
        <p class="font-semibold">{{ $label }}</p>
    </span>
</a>