@props(['icon' => '', 'url' => ''])

<a {{ $attributes->merge(['href' => $url, 'class' => 'text-xs transition ease-in-out
    opacity-50 hover:opacity-100']) }}>
    @if($icon != '')
        <i class="fa fa-{{ $icon }} ml-2"></i>
    @endif
</a>