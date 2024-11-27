<?php

namespace App\Livewire\Home\Produk;

use App\Models\CartItems;
use App\Models\Carts;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class KeranjangDanBeli extends Component
{
    public $produk;

    public function render()
    {
        return view('livewire.home.produk.keranjang-dan-beli');
    }

    public function addToCart()
    {
        $id = $this->produk->id;
        if (!Auth::check()) {
            $this->redirect(route('login'));
            return;
        }

        $produk = Products::find($id);
        if (!$produk) {
            $this->dispatch('notify', message: 'Produk tidak ditemukan', type: 'error');
            return;
        }

        $existingCart = Carts::where('user_id', Auth::user()->id)
            ->first();

        if ($existingCart) {
            $existingCartItem = CartItems::where('carts_id', $existingCart->id)
                ->where('products_id', $produk->id)
                ->first();
            if ($existingCartItem) {
                $existingCartItem->update([
                    'quantity' => $existingCartItem->quantity + 1,
                    'total_amount' => $produk->price * ($existingCartItem->quantity + 1)
                ]);

                $existingCart->update([
                    'total_amount' => CartItems::where('carts_id', $existingCart->id)
                        ->sum('price')
                ]);

                $this->dispatch('cartAdded');
                $this->dispatch('notify', message: 'Jumlah produk berhasil diupdate', type: 'success');
                return;
            }

            CartItems::create([
                'carts_id' => $existingCart->id,
                'products_id' => $produk->id,
                'quantity' => 1,
                'price' => $produk->price,
                'created_at' => now()
            ]);

            $existingCart->update([
                'total_amount' => CartItems::where('carts_id', $existingCart->id)
                    ->sum('price')
            ]);
        } else {
            $cart = Carts::create([
                'user_id' => Auth::user()->id,
                'total_amount' => $produk->price,
                'created_at' => now()
            ]);

            CartItems::create([
                'carts_id' => $cart->id,
                'products_id' => $produk->id,
                'quantity' => 1,
                'price' => $produk->price,
                'created_at' => now()
            ]);
        }

        $this->dispatch('cartAdded');
        $this->dispatch('notify', message: 'Produk berhasil ditambahkan ke keranjang', type: 'success');
    }

    // public function buyNow($produkId)
    // {
    //     try {
    //         $id = decrypt($produkId);
    //     } catch (\Throwable $th) {
    //         $this->redirect(route('semua-produk'));
    //     }

    //     $produk = Products::find($id);
    //     if (!$produk) {
    //         $this->dispatch('notify', message: 'Produk tidak ditemukan', type: 'error');
    //         return;
    //     }

    //     $order = Orders::create([
    //         'invoice_number' => 'ORDER-' . uniqid(),
    //         'user_id' => Auth::user()->id,
    //         'total_amount' => $produk->price,
    //         'payment_status' => 'pending',
    //         'created_at' => now()
    //     ]);

    //     OrderItems::create([
    //         'order_id' => $order->id,
    //         'products_id' => $produk->id,
    //         'quantity' => 1,
    //         'price' => $produk->price,
    //         'created_at' => now()
    //     ]);

    //     return $this->redirect(route('checkout', strtolower($order->invoice_number)));
    // }

    public function buyNow($produkId)
    {
        try {
            $id = decrypt($produkId);
        } catch (\Throwable $th) {
            return redirect(route('semua-produk'));
        }

        $produk = Products::find($id);
        if (!$produk) {
            $this->dispatch('notify', message: 'Produk tidak ditemukan', type: 'error');
            return;
        }

        // Periksa apakah sudah ada invoice number di session
        $tempOrder = session('temp_order');
        $invoiceNumber = $tempOrder['invoice_number'] ?? null;

        // Jika belum ada invoice number, generate baru
        if (!$invoiceNumber) {
            $invoiceNumber = 'ORDER-' . uniqid();
        }

        session()->put('temp_order', [
            'invoice_number' => $invoiceNumber,
            'items' => [
                [
                    'products_id' => $produk->id,
                    'name' => $produk->name,
                    'quantity' => 1,
                    'price' => $produk->price
                ]
            ],
            'total_amount' => $produk->price,
            'user_id' => Auth::user()->id,
            'is_from_cart' => false
        ]);

        return $this->redirect(route('checkout', strtolower($invoiceNumber)));
    }
}
