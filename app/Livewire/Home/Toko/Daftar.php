<?php

namespace App\Livewire\Home\Toko;

use App\Models\Shops;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Daftar extends Component
{
    public $name, $url, $description, $city, $country, $state, $zip, $address;
    public $step = 1;

    protected function rules()
    {
        if ($this->step == 1) {
            return [
                'name' => 'required',
                'url' => 'required',
                'description' => 'required',
                'city' => 'nullable',
                'country' => 'nullable',
                'state' => 'nullable',
                'zip' => 'nullable|numeric',
                'address' => 'nullable',
            ];
        } else {
            return [
                'name' => 'nullable',
                'url' => 'nullable',
                'description' => 'nullable',
                'city' => 'required',
                'country' => 'required',
                'state' => 'required',
                'zip' => 'required|numeric',
                'address' => 'required',
            ];
        }
    }

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->url = Str::slug($this->name);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedName()
    {
        $this->url = Str::slug($this->name);
    }

    public function render()
    {
        return view('livewire.home.toko.daftar');
    }

    public function submit()
    {
        try {
            $this->validate();
        } catch (ValidationException $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }

        if (Shops::where('name', $this->name)->exists()) {
            $this->dispatch('notify', message: 'Nama toko sudah digunakan, silakan pilih nama lain.', type: 'error');
            return;
        }

        try {
            Shops::create([
                'user_id' => Auth::id(),
                'name' => $this->name,
                'slug' => Str::slug($this->name),
                'description' => $this->description,
                'city' => $this->city,
                'country' => $this->country,
                'province' => $this->state,
                'postal_code' => $this->zip,
                'address' => $this->address,
                'status' => 'active'
            ]);

            session()->flash('success', 'Toko berhasil dibuat!');
            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }
    }

    public function next()
    {
        $this->validate();
        $this->step = 2;
    }

    public function prev()
    {
        $this->step = 1;
    }
}
