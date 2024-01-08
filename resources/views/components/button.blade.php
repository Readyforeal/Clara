@props(['icon' => '', 'bgColor' => 'bg-black dark:bg-blue-100', 'textColor' => 'text-white dark:text-blue-600', 'borderColor' => 'border-black dark:border-blue-600'])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2 border ' . $borderColor . ' rounded-xl font-semibold text-xs ' . $textColor . ' ' . $bgColor . ' hover:opacity-80 focus:opacity-80 active:opacity-80 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    @if($icon != '')
    <i class="fa fa-{{ $icon }} {{ $slot == '' ? '' : 'mr-2' }}"></i>
    @endif
    {{ $slot }}
</button>
