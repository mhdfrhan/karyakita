<?php

namespace App\Livewire\Home\Produk;

use App\Models\Carts;
use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Checkout extends Component
{
    public $order, $paymentMethod;

    protected $rules = [
        'paymentMethod' => 'required'
    ], $messages = [
        'required' => ':attribute harus diisi.'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.home.produk.checkout');
    }

    public function checkout()
    {
        try {
            $this->validate();
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }

        $totalAmount = $this->order["total_amount"];
        $pajak = $totalAmount * 0.1; // 10% pajak
        $totalAmountDenganPajak = $totalAmount + $pajak;

        // Periksa apakah pesanan sudah ada berdasarkan nomor invoice
        $existingOrder = Orders::where('invoice_number', $this->order["invoice_number"])->first();

        $saldo = Auth::user()->saldo;

        if ($existingOrder) {
            // Hapus order items yang sudah ada
            OrderItems::where('order_id', $existingOrder->id)->delete();

            // Update order
            $existingOrder->update([
                'total_amount' => $totalAmount,
                'payment_status' => $this->paymentMethod == 'saldo' ? 'paid' : 'pending',
                'created_at' => now()
            ]);

            // Buat ulang order items
            foreach ($this->order["items"] as $item) {
                OrderItems::create([
                    'order_id' => $existingOrder->id,
                    'products_id' => $item["products_id"],
                    'quantity' => $item["quantity"],
                    'price' => $item["price"],
                    'created_at' => now()
                ]);
            }

            // Jika pembayaran dengan saldo
            if ($this->paymentMethod == 'saldo') {
                if ($saldo < $totalAmountDenganPajak) {
                    $this->dispatch('notify', message: 'Saldo anda tidak cukup.', type: 'error');
                    return;
                }

                Auth::user()->update([
                    'saldo' => $saldo - $totalAmountDenganPajak
                ]);

                if ($this->order["is_from_cart"]) {
                    $cart = Carts::where('user_id', Auth::user()->id)->first();
                    $cart->delete();
                }
                session()->forget('temp_order');
                session()->flash('success', 'Pembayaran berhasil.');
                return $this->redirect(route('home.dashboard', Auth::user()->username));
            }

            if ($this->order["is_from_cart"]) {
                $cart = Carts::where('user_id', Auth::user()->id)->first();
                $cart->delete();
            }
            session()->forget('temp_order');
            return $this->redirect(route('paymentProduk', $this->order["invoice_number"]));
        }

        // Jika order belum ada, buat order baru
        if ($this->paymentMethod == 'saldo') {
            if ($saldo < $totalAmountDenganPajak) {
                $this->dispatch('notify', message: 'Saldo anda tidak cukup.', type: 'error');
                return;
            }

            $order = Orders::create([
                'invoice_number' => $this->order["invoice_number"],
                'user_id' => Auth::user()->id,
                'total_amount' => $totalAmount,
                'payment_status' => 'paid',
                'created_at' => now()
            ]);

            foreach ($this->order["items"] as $item) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'products_id' => $item["products_id"],
                    'quantity' => $item["quantity"],
                    'price' => $item["price"],
                    'created_at' => now()
                ]);
            }

            Auth::user()->update([
                'saldo' => $saldo - $totalAmountDenganPajak
            ]);

            if ($this->order["is_from_cart"]) {
                $cart = Carts::where('user_id', Auth::user()->id)->first();
                $cart->delete();
            }
            session()->forget('temp_order');
            session()->flash('success', 'Pembayaran berhasil.');
            return $this->redirect(route('home.dashboard', Auth::user()->username));
        } else {
            $order = Orders::create([
                'invoice_number' => $this->order["invoice_number"],
                'user_id' => Auth::user()->id,
                'total_amount' => $totalAmount,
                'payment_status' => 'pending',
                'created_at' => now()
            ]);

            foreach ($this->order["items"] as $item) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'products_id' => $item["products_id"],
                    'quantity' => $item["quantity"],
                    'price' => $item["price"],
                    'created_at' => now()
                ]);
            }

            if ($this->order["is_from_cart"]) {
                $cart = Carts::where('user_id', Auth::user()->id)->first();
                $cart->delete();
            }
            session()->forget('temp_order');
            return $this->redirect(route('paymentProduk', $this->order["invoice_number"]));
        }
    }
}
