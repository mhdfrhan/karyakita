<div>
    @include('components.alert')
    
    @empty(!$produk->count())
        <div wire:loading.class="opacity-50"
            class="{{ $viewType === 'grid' ? 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6' : '' }}">
            @foreach ($produk as $p)
                <livewire:home.components.product-card produkId="{{ $p->id }}"
                    image="{{ asset($p->images->where('is_primary', true)->first()->image_path) }}"
                    title="{{ htmlspecialchars($p->name) }}" rating="4.8 (200)" price="{{ $p->price }}"
                    category="{!! $p->category->name !!}" categorySlug="{{ $p->category->slug }}" slug="{{ $p->slug }}"
                    listView="{{ $viewType }}" lazy />
            @endforeach
        @else
            <p class="text-center mt-8 text-neutral-500">Ups, Produk tidak ditemukan</p>
        </div>
    @endempty
    @push('scripts')
        <script>
            document.addEventListener('scroll', function() {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    @this.loadMoreProducts();
                }
            });
        </script>
    @endpush
</div>
