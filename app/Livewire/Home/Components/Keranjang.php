<?php

namespace App\Livewire\Home\Components;

use App\Models\CartItems;
use App\Models\Carts;
use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Str;

class Keranjang extends Component
{
    public $totalKeranjang = 0, $keranjang = [];

    public function mount()
    {
        if (Auth::check()) {
            $this->totalKeranjang = CartItems::whereHas('cart', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->count();
        } else {
            $this->totalKeranjang = 0;
        }
    }

    #[On('cartAdded')]
    public function refreshKeranjang()
    {
        if (Auth::check()) {
            $this->totalKeranjang = CartItems::whereHas('cart', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })->count();
        } else {
            $this->totalKeranjang = 0;
        }
    }

    public function render()
    {
        if (Auth::check()) {
            $cartId = Carts::where('user_id', Auth::user()->id)->pluck('id')->first();

            if ($cartId == null) {
                return view('livewire.home.components.keranjang', [
                    'keranjang' => []
                ]);
            }
            $items = CartItems::where('carts_id', $cartId)->get();
            $this->keranjang = $items;
        } else {
            $items = [];
        }


        return view('livewire.home.components.keranjang', [
            'keranjang' => $this->keranjang
        ]);
    }

    public function increment($id)
    {
        $item = collect($this->keranjang)->where('id', $id)->first();

        $item->increment('quantity');
        $item->price = $item->product->price * $item->quantity;
        $item->cart->update(['total_amount' => $item->product->price * $item->quantity]);


        $item->save();
    }

    public function decrement($id)
    {
        $item = collect($this->keranjang)->where('id', $id)->first();

        if ($item->quantity > 1) {
            $item->decrement('quantity');
            $item->price = $item->product->price * $item->quantity;
            $item->cart->update(['total_amount' => $item->product->price * $item->quantity]);
            $item->save();
        } else {
            $item->delete();

            $cart = Carts::where('user_id', Auth::user()->id)->first();

            if (CartItems::where('carts_id', $cart->id)->count() === 0) {
                $cart->delete();
            }

            $this->dispatch('cartAdded');
            $this->dispatch('notify', message: 'Produk berhasil dihapus dari keranjang', type: 'success');
        }
    }

    // public function checkout()
    // {
    //     $cart = Carts::where('user_id', Auth::user()->id)->get();
    //     $cartItems = CartItems::where('carts_id', $cart->first()->id)->get();

    //     $order = Orders::create([
    //         'invoice_number' => 'ORDER-' . uniqid(),
    //         'user_id' => Auth::user()->id,
    //         'total_amount' => $cart->sum('total_amount'),
    //         'payment_status' => 'pending',
    //         'created_at' => now()
    //     ]);

    //     foreach ($cartItems as $item) {
    //         OrderItems::create([
    //             'order_id' => $order->id,
    //             'products_id' => $item->products_id,
    //             'quantity' => $item->quantity,
    //             'price' => $item->price
    //         ]);

    //         $item->delete();
    //     }

    //     return $this->redirect(route('checkout', strtolower($order->invoice_number)));
    // }

    public function checkout()
    {
        $cart = Carts::where('user_id', Auth::user()->id)->first();
        $cartItems = CartItems::where('carts_id', $cart->id)->get();

        // Periksa apakah sudah ada invoice number di session
        $tempOrder = session('temp_order');
        $invoiceNumber = $tempOrder['invoice_number'] ?? null;

        // Jika belum ada invoice number, generate baru
        if (!$invoiceNumber) {
            $invoiceNumber = 'ORDER-' . uniqid();
        }

        // Persiapkan data order sementara
        $tempOrderItems = $cartItems->map(function ($item) {
            return [
                'products_id' => $item->products_id,
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => $item->price
            ];
        });

        session()->put('temp_order', [
            'invoice_number' => $invoiceNumber,
            'items' => $tempOrderItems->toArray(),
            'total_amount' => $cartItems->sum('price'),
            'user_id' => Auth::user()->id,
            'is_from_cart' => true
        ]);

        return $this->redirect(route('checkout', strtolower($invoiceNumber)));
    }
}
