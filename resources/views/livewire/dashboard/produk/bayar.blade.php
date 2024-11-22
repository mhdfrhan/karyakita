<div>
    @include('components.message')
    @include('components.alert')

    <div class="flex flex-col items-center justify-center min-h-[60vh]">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-semibold mb-2">Pembayaran Iklan Produk</h1>
            <p class="text-neutral-500">Silahkan selesaikan pembayaran untuk melanjutkan</p>
        </div>

        <div class="w-full max-w-md p-6 bg-white rounded-2xl shadow-xl shadow-neutral-200">
            <div class="mb-6 pb-6 border-b">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-neutral-500">Invoice</span>
                    <span class="font-medium">{{ $ads->invoice_number }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-neutral-500">Total Pembayaran</span>
                    <span class="font-medium">Rp {{ number_format($ads->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <x-primary-button type="button" id="pay-button" class="w-full">
                Bayar Sekarang
            </x-primary-button>
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
