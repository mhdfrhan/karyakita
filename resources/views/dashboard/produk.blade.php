<x-app-layout>
    @include('components.message')
    <x-slot name="title">{{ $title }}</x-slot>

    <section>
        <livewire:dashboard.produk.index>
    </section>
</x-app-layout>
