<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-red-500 text-white py-2 px-6  rounded-full hover:bg-red-500 duration-300 shadow-lg shadow-red-500/30 hover:shadow-red-500/30 active:scale-95']) }}>
    {{ $slot }}
</button>
