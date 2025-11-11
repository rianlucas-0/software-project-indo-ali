@props(['id', 'name', 'value'])

<input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
    {{ $attributes->merge(['class' => 'rounded border-gray-300 dark:border-gray-600 text-blue-500 focus:ring-blue-500 dark:focus:ring-blue-400']) }}>