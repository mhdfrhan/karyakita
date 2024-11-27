<div class="max-w-lg mx-auto border border-neutral-300 rounded-2xl p-5">
    <div class="text-center mb-8">
        <h4 class="text-lg font-semibold">Pembayaran</h4>
        <p class="text-neutral-500">#{{ $order->invoice_number }}</p>
    </div>
    <div>
        <ul class="space-y-4 mb-4">
            @foreach ($items as $item)
                <li class="inline-flex gap-3 w-full">
                    <img src="{{ asset($item->product->images->where('is_primary', true)->first()->image_path) }}"
                        alt="{{ $item->product->name }}" class="h-20 rounded-lg">
                    <div class="flex justify-between w-full">
                        <div>
                            <h6 class="font-medium line-clamp-2">{{ $item->product->name }}</h6>
                            <p class="text-neutral-500">x{{ $item->quantity }}</p>
                        </div>
                        <div class="shrink-0 text-right">
                            <p class="font-medium">Rp. {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <ul class="space-y-2 mb-4">
            <li class="flex justify-between">
                <span class="text-neutral-500">Subtotal</span>
                <span class="text-neutral-500">Rp.
                    {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </li>
            <li class="flex justify-between">
                <span class="text-neutral-500">Pajak (10%)</span>
                <span class="text-neutral-500">Rp.
                    {{ number_format($order->total_amount * 0.1, 0, ',', '.') }}</span>
            </li>
            <li class="flex justify-between">
                <span class="text-neutral-800 font-medium">Total</span>
                <span class="text-neutral-800 font-medium">Rp.
                    {{ number_format($order->total_amount * 1.1, 0, ',', '.') }}</span>
            </li>
        </ul>
        <div>
            <x-primary-button class="w-full" id="pay-button">{{ __('Bayar sekarang') }}</x-primary-button>
        </div>
    </div>

    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
        </script>
        <script>
            document.getElementById('pay-button').onclick = function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        @this.dispatch('payment-success');

                        setTimeout(() => {
                            @this.navigate('dashboard.produk');
                        }, 4000);
                    },
                    onPending: function(result) {
                        @this.dispatch('payment-pending', result);
                    },
                    onError: function(result) {
                        @this.dispatch('payment-error', result);
                    },
                    onClose: function() {
                        @this.dispatch('payment-close');
                    }
                });
            };
        </script>
    @endpush
</div>
