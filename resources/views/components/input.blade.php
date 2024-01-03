@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-white bg-gray-50 hover:bg-white focus:border-blue-500 focus:bg-white focus:ring-blue-500 rounded-xl shadow transition ease-in-out']) !!}>
