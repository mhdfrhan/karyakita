<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ServicePay;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function jasa()
    {
        return view('dashboard.jasa.index', [
            'title' => 'Jasa Kamu',
        ]);
    }

    public function tambahJasa()
    {
        return view('dashboard.jasa.tambah', [
            'title' => 'Tambah - Tambah Jasa',
        ]);
    }

    public function editJasa($slug)
    {
        $service = Services::where('slug', $slug)->first();

        if (!$service) {
            return redirect(route('dashboard.jasa'));
        }

        return view('dashboard.jasa.edit', [
            'title' => 'Edit - Tambah Jasa',
            'service' => $service
        ]);
    }

    public function bayar($slug)
    {
        $servicePay = ServicePay::where('invoice_number', $slug)->first();

        if (!$servicePay) {
            return redirect(route('dashboard.jasa'));
        }

        return view('dashboard.jasa.bayar', [
            'title' => 'Bayar - Tambah Jasa',
            'service' => $servicePay
        ]);
    }
}
