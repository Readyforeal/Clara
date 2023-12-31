@props(['icon' => '', 'url' => ''])

<a {{ $attributes->merge(['href' => $url, 'class' => 'inline-flex items-center px-6 py-2 font-semibold text-xs border shadow rounded-xl transition ease-in-out
    bg-gray-50 hover:bg-white border-white text-black group']) }}>

    @if($icon != '')
        <i class="fa fa-{{ $icon }} mr-2"></i>
    @endif
    @isset($slot)
        {{ $slot }}
    @endisset
    
</a>