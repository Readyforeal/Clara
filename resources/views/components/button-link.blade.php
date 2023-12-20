@props(['icon' => '', 'url' => ''])
<a {{ $attributes->merge(['href' => $url, 'class' => 'inline-flex items-center px-4 py-2 bg-neutral-900 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-neutral-700 focus:bg-neutral-700 active:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    @isset($icon)
    <i class="fa fa-{{ $icon }} text-blue-400 mr-2"></i>
    @endisset
    {{ $slot }}
</a>
