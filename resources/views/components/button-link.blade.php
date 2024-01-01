@props(['icon' => '', 'url' => ''])

<a {{ $attributes->merge(['href' => $url, 'class' => 'inline-flex items-center px-6 py-2 font-semibold text-xs border rounded-xl transition ease-in-out
    bg-black hover:bg-gray-800 border-transparent text-gray-100 hover:text-white']) }}>
    @isset($slot)
        {{ $slot }}
    @endisset
    @if($icon != '')
        <i class="fa fa-{{ $icon }} ml-2"></i>
    @endif
</a>