@props(['disabled' => false])

<select @disabled($disabled)  {{ $attributes->merge(['class' => 'block w-full bg-transparent border border-neutral-400 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500']) }}>
   {{ $slot }}
</select>