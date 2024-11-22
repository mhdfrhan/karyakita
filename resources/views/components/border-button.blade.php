<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'border border-neutral-300 text-neutral-600 py-2 px-6  rounded-full hover:bg-neutral-100 duration-300  active:scale-95']) }}>
    {{ $slot }}
</button>
