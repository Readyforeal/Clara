@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} type="checkbox" {!! $attributes->merge(['class' => 'rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-600']) !!}>