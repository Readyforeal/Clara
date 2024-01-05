@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} type="checkbox" {!! $attributes->merge(['class' => 'rounded border-gray-300 text-blue-500 shadow-sm focus:ring-blue-500']) !!}>