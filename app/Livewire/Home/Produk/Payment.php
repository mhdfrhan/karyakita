<?php

namespace App\Livewire\Home\Produk;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Mutations;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Payment extends Component
{
    public $order;
    public $snapToken;

    public function mount()
    {
        $this->processPayment();
    }

    protected function processPayment()
    {
        try {
            $this->configureMidtrans();
            $items = $this->getItemsDetails();
            $params = $this->generateTransactionParams($items);
            $this->snapToken = Snap::getSnapToken($params);
            $this->updateOrderWithSnapToken();
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Pembayaran gagal: ' . $e->getMessage(), type: 'error');
        }
    }

    protected function configureMidtrans()
    {
        try {
            Config::$serverKey = config('midtrans.serverKey');
            Config::$isProduction = config('midtrans.isProduction', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }
    }

    public function getItemsDetails()
    {
        try {
            $items = [];
            $orderItems = OrderItems::where('order_id', $this->order->id)->get();

            foreach ($orderItems as $item) {
                $items[] = [
                    'id' => $item->products_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'name' => $item->product->name,
                ];
            }

            // Tambahkan pajak 10% sebagai item tambahan
            $taxAmount = $this->order->total_amount * 0.1;
            $items[] = [
                'id' => 'TAX',
                'price' => $taxAmount,
                'quantity' => 1,
                'name' => 'Tax 10%',
            ];

            return $items;
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return [];
        }
    }


    public function generateTransactionParams($items)
    {
        try {
            $grossAmount = $this->order->total_amount + ($this->order->total_amount * 0.1);
            $params = [
                'transaction_details' => [
                    'order_id' => $this->order->invoice_number,
                    'gross_amount' => $grossAmount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone ?? '',
                ],
                'item_details' => $items,
            ];
            return $params;
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return [];
        }
    }


    public function updateOrderWithSnapToken()
    {
        try {
            $this->order->update([
                'snap_token' => $this->snapToken
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }
    }

    public function render()
    {
        $items = OrderItems::where('order_id', $this->order->id)->get();
        return view('livewire.home.produk.payment', [
            'items' => $items
        ]);
    }

    #[On('payment-success')]
    public function paymentSuccess()
    {
        $this->order->update([
            'payment_status' => 'paid',
            'snap_token' => null
        ]);

        // Catat mutasi
        $mutasi = Mutations::create([
            'user_id' => Auth::user()->id,
            'type' => 'remove',
            'name' => 'Pembayaran Produk',
            'description' => 'Pembayaran produk dengan nomor invoice ' . $this->order->invoice_number .
                ' sebesar Rp ' . number_format($this->order->total_amount + $this->order->total_amount * 0.1, 0, ',', '.'),
            'amount' => $this->order->total_amount + $this->order->total_amount * 0.1,
            'created_at' => now()
        ]);

        $this->dispatch('notify', message: 'Pembayaran produk berhasil', type: 'success');
        return redirect(route('home.dashboard', Auth::user()->username));
    }

    #[On('payment-pending')]
    public function paymentPending($result)
    {
        $this->dispatch('notify', message: 'Pembayaran dalam proses', type: 'warning');
    }

    #[On('payment-error')]
    public function paymentError($result)
    {
        $this->dispatch('notify', message: 'Pembayaran gagal', type: 'error');
        return redirect(route('semua-produk'));
    }

    #[On('payment-close')]
    public function paymentClose()
    {
        session()->flash('error', 'Pembayaran dibatalkan');
        return redirect(route('home.dashboard', Auth::user()->username));
    }

    public function navigate($route)
    {
        return $this->redirect(route($route));
    }
}
