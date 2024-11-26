@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center py-2.5 px-3 rounded-xl shadow-lg shadow-white/30 font-medium leading-5 text-black focus:outline-none transition duration-150 ease-in-out bg-white w-full'
            : 'inline-flex items-center py-2.5 px-3 rounded-xl font-medium leading-5 text-indigo-100 hover:text-white hover:bg-indigo-600 w-full focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
