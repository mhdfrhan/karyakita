@props(['disabled' => false])

<select @disabled($disabled)
    {{ $attributes->merge(['class' => 'block w-full bg-transparent border border-neutral-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 placeholder:text-neutral-400/80 placeholder:text-sm']) }}>
    {{ $slot }}
</select>
