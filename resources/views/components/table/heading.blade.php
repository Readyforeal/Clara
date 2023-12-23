@props(['sortable' => null, 'direction' => null])
<th {{ $attributes->merge(['class' => 'px-6 py-3 bg-white'])->only('class') }}>
    @unless ($sortable)
        <p class="text-left text-xs leading-4 font-semibold">{{ $slot }}</p>
    @else
        <button {{ $attributes->except('class') }} class="flex items-center space-x-2 text-left text-xs leading-4 font-semibold group">
            <span>{{ $slot }}</span>
            <span>
                @if($direction === 'asc')
                    <i class="fa fa-chevron-up"></i>
                @elseif($direction === 'desc')
                    <i class="fa fa-chevron-down"></i>
                @else
                    <i class="fa fa-chevron-up opacity-30 group-hover:opacity-100 transition ease-in-out"></i>
                @endif
            </span>
        </button>
    @endunless
</th>