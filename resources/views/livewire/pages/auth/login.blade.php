<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Shops;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $toko = Shops::where('user_id', Auth::user()->id)->first();
        if ($toko != null) {
            Session::flash('success', 'Yeay, kamu berhasil login!');
            return redirect(route('dashboard'));
        }

        return redirect(route('home'));
    }
}; ?>

<div>
    <h1 class="text-2xl font-semibold text-center">{{ __('Hai, Selamat Datang Kembali👋') }}</h1>
    <p class="mt-2 text-center text-neutral-400">
        Masukkan kredensial kamu untuk mengakses akun kamu
    </p>
    <div class="mt-6">
        <div class="flex items-center gap-3 justify-center">
            <a href="">
                <x-border-button class="flex items-center gap-2 font-medium !text-neutral-700 !rounded-xl text-sm">
                    <img src="https://static.cdnlogo.com/logos/g/35/google-icon.svg" alt="Google" class="w-5">
                    <span>{{ __('Login with Google') }}</span>
                </x-border-button>
            </a>
            <a href="">
                <x-border-button class="flex items-center gap-2 font-medium !text-neutral-700 !rounded-xl text-sm">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple"
                        class="w-4">
                    <span>{{ __('Login with Apple') }}</span>
                </x-border-button>
            </a>
        </div>
        <div class="relative text-center mt-6">
            <div class="absolute w-full border-t border-neutral-300/80 z-0 top-1/2"></div>
            <p class="text-center text-neutral-400 bg-white px-4 z-10 inline-block relative">Atau</p>
        </div>
    </div>

    <div class="mt-6">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login">
            <!-- Email Address / Username -->
            <div>
                <x-input-label for="login" :value="__('Username/Email*')" />
                <x-text-input wire:model.live="form.login" id="login" class="block mt-1 w-full" type="text"
                    name="login" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('form.login')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password*')" />

                <x-text-input wire:model.live="form.password" id="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between gap-3">
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember" class="inline-flex items-center">
                        <input wire:model="form.remember" id="remember" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a class="text-red-500 text-sm hover:text-red-600 hover:underline"
                        href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="mt-4">

                <x-primary-button class="w-full">
                    {{ __('Log in') }}
                </x-primary-button>

                <p class="mt-4 text-sm text-center">Belum mempunyai akun? <a
                        class="text-indigo-500 hover:text-indigo-600 hover:underline" href="{{ route('register') }}"
                        wire:navigate>Daftar disini</a></p>
            </div>
        </form>
    </div>
</div>
