<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'bg-white text-black py-2 px-6 font-medium rounded-full hover:bg-white duration-300 shadow-lg shadow-white/30 hover:shadow-white/30 active:scale-95']) }}>
    {{ $slot }}
</button>
