<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dashboard'
        ]);
    }

    public function mutasiSaldo() {
        return view('dashboard.saldo.mutasi', [
            'title' => 'Mutasi Saldo'
        ]);
    }

    public function penarikanSaldo() {
        return view('dashboard.saldo.penarikan', [
            'title' => 'Penarikan Saldo'
        ]);
    }
}
