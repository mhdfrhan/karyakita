@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'block w-full bg-transparent border border-neutral-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 ']) }}></textarea>