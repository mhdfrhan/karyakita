<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $phone = '';
    public string $birth_date = '';
    public string $gender = 'male';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:15', 'unique:' . User::class],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ];
    }

    protected $messages = [
        'required' => ':attribute harus diisi.',
        'unique' => ':attribute sudah terdaftar.',
        'confirmed' => 'Password konfirmasi tidak cocok.',
        'gender.in' => 'Jenis kelamin harus dipilih.',
        'date' => 'Format tanggal salah.',
        'max' => ':attribute maksimal :max karakter.',
        'string' => ':attribute harus berupa teks.',
        'email' => ':attribute harus berupa email.',
        'lowercase' => ':attribute harus berupa huruf kecil.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedPasswordConfirmation()
    {
        $this->validate([
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);
    }

    public function register(): void
    {
        try {
            try {
                $validated = $this->validate();
                $validated['password'] = Hash::make($validated['password']);
            } catch (\ValidationException $e) {
                $this->dispatch('notify', message: $e->getMessage(), type: 'error');
                return;
            }

            event(new Registered(($user = User::create($validated))));
            Auth::login($user);
            $this->redirect(route('home', absolute: false));
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
        }
    }
}; ?>

<div>
    <h1 class="text-3xl font-semibold text-center">{{ __('Daftar sekarang') }}</h1>
    <p class="mt-2 text-center text-neutral-400">
        Silahkan isi form dibawah ini untuk memulai menjelajahi karyakita
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
    <form wire:submit="register" class="mt-6">
        <div class="grid sm:grid-cols-2 gap-4">

            <div>
                <x-input-label for="name" :value="__('Fullname*')" />
                <x-text-input wire:model.live="name" id="name" class="block mt-1 w-full" type="text"
                    name="name" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="username" :value="__('Username*')" />
                <x-text-input wire:model.live="username" id="username" class="block mt-1 w-full" type="text"
                    name="username" required autocomplete="username" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email*')" />
                <x-text-input wire:model.live="email" id="email" class="block mt-1 w-full" type="email"
                    name="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('No. Handphone*')" />
                <x-text-input wire:model.live="phone" id="phone" class="block mt-1 w-full" type="text"
                    name="phone" required autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="birth_date" :value="__('Tanggal Lahir*')" />
                <x-text-input wire:model.live="birth_date" id="birth_date" class="block mt-1 w-full" type="date"
                    name="birth_date" required />
                <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="gender" :value="__('Jenis Kelamin*')" />
                <x-select-input class="mt-1" id="gender" wire:model.live="gender">
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                </x-select-input>


                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password*')" />
                <x-text-input wire:model.live="password" id="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password*')" />
                <x-text-input wire:model.live="password_confirmation" id="password_confirmation"
                    class="block mt-1 w-full" type="password" name="password_confirmation" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

        </div>

        <small class="text-sm text-neutral-400">* Password harus minimum 8 karakter</small>

        <div class="mt-4">
            <x-primary-button class="w-full">
                {{ __('Register') }}
            </x-primary-button>

            <p class="mt-4 text-sm text-center">Sudah memiliki akun? <a
                    class="text-indigo-500 hover:text-indigo-600 hover:underline" href="{{ route('login') }}"
                    wire:navigate>Login</a></p>
        </div>
    </form>
</div>
