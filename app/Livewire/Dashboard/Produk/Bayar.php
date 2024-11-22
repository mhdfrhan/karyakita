<?php

namespace App\Livewire\Dashboard\Produk;

use App\Models\Advertisements;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Bayar extends Component
{
    public $ads, $snapToken;

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
            $this->updateAdsWithSnapToken();
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
            $items[] = [
                'id' => $this->ads->invoice_number,
                'price' => $this->ads->price,
                'name' => $this->ads->product->name,
                'category' => $this->ads->product->category->name,
            ];
            return $items;
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }
    }

    public function generateTransactionParams($items)
    {
        try {
            $params = [
                'transaction_details' => [
                    'order_id' => $this->ads->invoice_number,
                    'gross_amount' => $this->ads->price,
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
            return;
        }
    }

    public function updateAdsWithSnapToken()
    {
        try {
            $this->ads->update([
                'snap_token' => $this->snapToken
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.produk.bayar');
    }

    #[On('payment-success')]
    public function paymentSuccess()
    {
        $this->ads->update([
            'status' => 'active',
            'snap_token' => null
        ]);

        $this->dispatch('notify', message: 'Pembayaran iklan produk berhasil', type: 'success');
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
        return redirect(route('dashboard.produk'));
    }

    #[On('payment-close')]
    public function paymentClose()
    {
        $this->dispatch('notify', message: 'Pembayaran dibatalkan', type: 'warning');
        return redirect(route('dashboard.produk'));
    }

    public function navigate($route) {
        return $this->redirect(route($route));
    }
}
