@props(['icon' => '', 'url' => ''])

<a {{ $attributes->merge(['href' => $url, 'class' => 'text-xs transition ease-in-out
    text-gray-400 hover:text-black']) }}>
    @if($icon != '')
        <i class="fa fa-{{ $icon }} ml-2"></i>
    @endif
</a>