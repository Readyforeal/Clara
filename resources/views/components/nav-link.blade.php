@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-6 text-sm font-semibold bg-blue-500/10 opacity-100 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-6 text-sm font-semibold opacity-70 hover:opacity-100 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
