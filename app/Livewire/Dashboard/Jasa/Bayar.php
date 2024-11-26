<?php

namespace App\Livewire\Dashboard\Jasa;

use App\Models\Mutations;
use App\Models\Services;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Bayar extends Component
{
    public $jasa, $snapToken;

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

            $this->updateServiceWithSnapToken();

            $this->updateLoyaltyPoints();
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Payment failed: ' . $e->getMessage(), type: 'error');
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
                'id' => $this->jasa->invoice_number,
                'price' => $this->jasa->total_amount,
                'name' => $this->jasa->service()->title,
                'category' => $this->jasa->service()->category->name,
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
                    'order_id' => $this->jasa->invoice_number,
                    'gross_amount' => $this->jasa->total_amount,
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

    public function updateServiceWithSnapToken()
    {
        try {
            $this->jasa->update([
                'snap_token' => $this->snapToken
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.jasa.bayar');
    }

    #[On('payment-success')]
    public function paymentSuccess()
    {
        $jasa = Services::where('id', $this->jasa->services_id)->select('id')->first();
        $this->jasa->update([
            'status' => 'paid',
            'snap_token' => null
        ]);

        $mutasi = Mutations::create([
            'user_id' => Auth::user()->id,
            'type' => 'remove',
            'name' => 'Pembayaran jasa ' . $this->jasa->title,
            'description' => 'Pembayaran jasa' . $this->jasa->title . ' sebesar ' . number_format($this->jasa->total_amount, 0, ',', '.') . ' dengan nomor invoice ' . $this->jasa->invoice_number,
            'amount' => $this->jasa->total_amount,
            'created_at' => now()
        ]);

        $jasa->update([
            'admin_approved' => 1
        ]);

        $this->dispatch('notify', message: 'Pembayaran jasa ' . $this->jasa->title . ' berhasil', type: 'success');
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
        return redirect(route('dashboard.jasa'));
    }

    #[On('payment-close')]
    public function paymentClose()
    {
        $this->dispatch('notify', message: 'Pembayaran dibatalkan', type: 'warning');
        return redirect(route('dashboard.jasa'));
    }

    public function navigate($route) {
        return $this->redirect(route($route));
    }
}
