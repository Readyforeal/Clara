@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-white bg-gray-100 hover:bg-gray-50 focus:border-blue-500 focus:bg-gray-50 focus:ring-blue-500 rounded-xl shadow-inner transition ease-in-out']) !!}>
