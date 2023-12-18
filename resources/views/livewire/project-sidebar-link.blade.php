<a href="{{ $link }}" class="flex w-full py-2 text-left rounded-md opacity-70 group cursor-pointer hover:opacity-100 bg-white hover:bg-blue-100 transition ease-in-out">
    <span class="group-hover:translate-x-3 transition ease-in-out">
        <p class="font-semibold {{ $highlighted ? 'text-blue-600' : '' }}">{{ $label }}</p>
    </span>
</a>