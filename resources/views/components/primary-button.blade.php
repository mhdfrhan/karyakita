<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-indigo-500 text-white py-2 px-6  rounded-full hover:bg-indigo-500 duration-300 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/30 active:scale-95']) }}>
    {{ $slot }}
</button>
