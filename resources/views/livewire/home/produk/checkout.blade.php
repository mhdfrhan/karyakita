<div class="mt-10 max-w-sm mx-auto py-3">
    <ul class="space-y-3">
        <li class="flex justify-between">
            <span class="text-neutral-500">Subtotal</span>
            <span class="text-neutral-500">Rp.
                {{ number_format($order['total_amount'], 0, ',', '.') }}</span>
        </li>
        <li class="flex justify-between">
            <span class="text-neutral-500">Pajak (10%)</span>
            <span class="text-neutral-500">Rp.
                {{ number_format($order['total_amount'] * 0.1, 0, ',', '.') }}</span>
        </li>
        <li class="flex justify-between">
            <span class="text-neutral-800 font-medium">Total</span>
            <span class="text-neutral-800 font-medium">Rp.
                {{ number_format($order['total_amount'] * 1.1, 0, ',', '.') }}</span>
        </li>
        <div>
            <p class="font-medium mb-1">Pilih Metode Pembayaran</p>
            <li class="flex justify-between">
                <label for="transfer" class="cursor-pointer">
                    <input type="radio" id="transfer" name="payment" value="transfer" wire:model.live='paymentMethod'
                        class="text-indigo-500 focus:outline-indigo-500 duration-200" />
                    <span class="text-neutral-600">Transfer/Qris</span>
                </label>
                <label for="saldo" class="cursor-pointer">
                    <span class="text-neutral-600">Saldo Karyakita</span>
                    <input type="radio" id="saldo" name="payment" value="saldo" wire:model.live='paymentMethod'
                        class="text-indigo-500 focus:outline-indigo-500 duration-200" />
                </label>
            </li>
        </div>
    </ul>
    <div class="mt-4">
        <x-primary-button class="w-full disabled:cursor-not-allowed disabled:active:scale-100" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-checkout')" :disabled="!$paymentMethod">Bayar
            {{ number_format($order['total_amount'] * 1.1, 0, ',', '.') }}</x-primary-button>
        <small class="text-neutral-500 text-center mt-2 block">Saldomu sebesar Rp.
            {{ number_format(Auth::user()->saldo, 0, ',', '.') }}</small>
    </div>

    <x-modal align="center" name="confirm-checkout" :show="$errors->isNotEmpty()" focusable>
        <div class="p-6">

            <h2 class="text-lg font-medium text-gray-900">
                Apakah kamu yakin ingin melakukan pembayaran menggunakan {{ $paymentMethod }}?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                @if ($paymentMethod == 'saldo')
                    {{ __('Ketika pembayaran dilakukan, saldo karyakita akan berkurang.') }}
                @else
                    {{ __('Apakah kamu yakin ingin melakukan pembayaran menggunakan transfer/qris?') }}
                @endif
            </p>

            <div class="mt-6 flex justify-end">
                <x-border-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-border-button>

                <x-primary-button class="ms-3" wire:click='checkout'>
                    {{ __('Bayar ') . number_format($order['total_amount'] * 1.1, 0, ',', '.') }}
                </x-primary-button>
            </div>
        </div>
    </x-modal>
</div>
