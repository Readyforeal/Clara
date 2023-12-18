<a href="{{ $link }}" class="flex w-full py-2 text-left rounded-md opacity-70 group cursor-pointer hover:opacity-100 bg-white hover:bg-blue-100 transition ease-in-out">
    <span class="flex group-hover:translate-x-3 transition ease-in-out {{ $highlighted ? 'text-blue-600' : '' }}">
        <i class="{{ $icon }} mt-1 mr-3 group-hover:text-blue-600 transition ease-in-out"></i>
        <p class="font-semibold">{{ $label }}</p>
    </span>
</a>