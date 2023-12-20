@props(['icon' => '', 'url' => ''])
<a {{ $attributes->merge(['href' => $url, 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    @isset($icon)
        <i class="fa fa-{{ $icon }} text-blue-400 mr-2"></i>
    @endisset
    {{ $slot }}
</a>