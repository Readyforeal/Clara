@props(['icon' => '', 'url' => '', 'bgColor' => 'bg-gray-100 dark:bg-blue-100', 'textColor' => 'text-black dark:text-blue-500', 'borderColor' => 'border-gray-300'])
<a {{ $attributes->merge(['href' => $url, 'class' => 'inline-flex items-center px-6 py-2 border ' . $borderColor . ' rounded-xl font-semibold text-xs ' . $textColor . ' ' . $bgColor . ' hover:opacity-80 focus:bg-gray-700 active:opacity-80 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    @if($icon != '')
        <i class="fa fa-{{ $icon }} {{ $slot->isNotEmpty() ? 'mr-2' : '' }}"></i>
    @endif
    
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @endif
</a>