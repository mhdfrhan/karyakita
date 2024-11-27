<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Shops;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        // $users = User::get();
        return view('dashboard.index', [
            'title' => 'Dashboard',
            // 'users' => $users
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
