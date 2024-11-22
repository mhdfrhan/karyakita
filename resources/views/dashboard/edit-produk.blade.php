<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <section>
        <div class="mb-8">
            <h1 class="text-2xl font-medium">Edit Produk {{ $product->name }}</h1>
            <p class="max-w-lg text-neutral-500 mt-1">
                Untuk mengedit produk, silahkan update detail form dibawah ini
            </p>
        </div>

        <livewire:dashboard.produk.edit :produk="$product">
    </section>
</x-app-layout>
