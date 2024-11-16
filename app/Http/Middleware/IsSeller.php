<?php

namespace App\Http\Middleware;

use App\Models\Shops;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $shop = Shops::where('user_id', Auth::user()->id)->first();
            if ($shop == null) {
                return redirect(route('daftarToko'));
            }
            return $next($request);
        } else {
            return redirect(route('login'));
        }
    }
}
