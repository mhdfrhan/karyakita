<x-main-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    @include('components.alert')

    <section class="pb-10 lg:pb-20">
        <div class="max-w-7xl mx-auto px-5">
            <livewire:home.produk.semua-filter>
                <div>
                    <livewire:home.produk.semua>
                </div>
        </div>
    </section>
</x-main-layout>
