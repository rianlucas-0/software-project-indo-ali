@props(['id', 'name', 'value'])

<input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
    {{ $attributes->merge(['class' => 'rounded border-gray-600 text-blue-500 focus:ring-blue-500']) }}>