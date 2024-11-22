<?php

namespace App\Livewire\Dashboard\Jasa;

use App\Models\ServiceCategories;
use App\Models\ServiceCategoriesType;
use App\Models\ServiceImages;
use App\Models\ServicePackages;
use App\Models\ServicePay;
use App\Models\ServicePrice;
use App\Models\Services;
use App\Models\ServiceSteps;
use App\Models\ServiceSubCategories;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Midtrans\Config;
use Midtrans\Snap;

class Edit extends Component
{
    use WithFileUploads;

    public $jasa;
    public $tipeKategoriList = [], $tipeKategori = "", $kategoriList = [], $kategori = "", $subKategoriList = [], $subKategori = "";
    public $title, $qldeskripsi, $description, $industry, $city, $province, $snapToken, $servicePrice, $price;
    public $provinces = [];
    public $regencies = [];
    public $packages = [];
    public $steps = [];
    public $images = [];
    public $isLongDistance = false;

    protected function rules()
    {
        return [
            'tipeKategori' => 'required',
            'kategori' => 'required',
            'subKategori' => 'required',
            'title' => 'required|min:10|max:50',
            'description' => 'required|min:20|max:500',
            'industry' => 'required|max:50',
            'city' => 'required',
            'province' => 'required',
            'packages' => 'required|array|min:1|max:3',
            'packages.*.name' => 'required|min:5|max:50',
            'packages.*.description' => 'required|min:20|max:200',
            'packages.*.duration' => 'required|numeric|min:1',
            'packages.*.price' => 'required|numeric|min:1000',
            'packages.*.revision' => $this->isLongDistance ? 'required|numeric|min:0' : 'nullable',
            'images' => 'required|array|min:1',
            'images.*.file' => 'nullable|image|max:2048',
            'steps' => 'required|array|min:3',
            'steps.*.title' => 'required|string|min:5|max:255',
        ];
    }

    public function mount()
    {

        $this->tipeKategoriList = ServiceCategoriesType::orderBy('name')->get();

        $this->provinces = DB::table('reg_provinces')->select(['id', 'name'])->get();
        $this->regencies = DB::table('reg_regencies')->where('province_id', $this->jasa->province)->select(['id', 'name'])->get();

        $this->qldeskripsi = 'quill-' . uniqid();

        // Load kategori
        $this->kategoriList = ServiceCategories::where('type_id', $this->jasa->type_id)->get();
        $this->subKategoriList = ServiceSubCategories::where('service_category_id', $this->jasa->category_id)->get();

        // Load data jasa
        $this->tipeKategori = $this->jasa->type->id;
        $this->kategori = $this->jasa->category->id;
        $this->subKategori = $this->jasa->subCategory->id;
        $this->title = $this->jasa->title;
        $this->description = $this->jasa->description;
        $this->industry = $this->jasa->industry;
        $this->province = $this->jasa->province;
        $this->city = $this->jasa->city;

        // Load packages
        $this->packages = $this->jasa->prices->map(function ($package) {
            return [
                'name' => $package->package_name,
                'description' => $package->description,
                'duration' => $package->duration,
                'price' => $package->price,
                'revision' => $package->total_revision
            ];
        })->toArray();

        // Load steps
        $this->steps = $this->jasa->steps->map(function ($step) {
            return [
                'title' => $step->step,
            ];
        })->toArray();

        // Load images
        $this->images = $this->jasa->images->map(function ($image) {
            return [
                'file' => null,
                'preview' => Storage::url($image->image_path),
                'name' => basename($image->image_path),
                'size' => Storage::exists($image->image_path) ? Storage::size($image->image_path) : 0,
                'id' => $image->id
            ];
        })->toArray();

        $this->isLongDistance = $this->jasa->type->name === 'Jarak Jauh';
    }

    public function updatedServicePrice($value)
    {
        $this->validate([
            'servicePrice' => 'required|in:1,3,6'
        ], [
            'servicePrice.required' => 'Pilih durasi pembayaran',
            'servicePrice.in' => 'Durasi pembayaran tidak valid'
        ]);
    }

    public function submitPayment()
    {
        $this->validate([
            'servicePrice' => 'required|in:1,3,6'
        ], [
            'servicePrice.required' => 'Pilih durasi pembayaran',
            'servicePrice.in' => 'Durasi pembayaran tidak valid'
        ]);

        if ((int)$this->servicePrice == 1) {
            $amount = 10000;
        } elseif ((int)$this->servicePrice == 3) {
            $amount = 25000;
        } elseif ((int)$this->servicePrice == 6) {
            $amount = 50000;
        } else {
            $this->dispatch('notify', message: 'Durasi pembayaran tidak valid', type: 'error');
            return;
        }

        if ($this->jasa->servicePay && $this->jasa->servicePay->first()) {
            foreach ($this->jasa->servicePay as $servicePay) {
                if ($servicePay->status == 'pending' || $servicePay->end_date < now()) {
                    $servicePay->delete();
                }
            }
        }
        $servicePay = ServicePay::create([
            'invoice_number' => 'JASA-' . uniqid(),
            'services_id' => $this->jasa->id,
            'total_amount' => $amount,
            'payment_date' => now(),
            'expiry_date' => now()->addMonths((int)$this->servicePrice),
            'created_at' => now(),
        ]);

        if ($servicePay) {
            Session::flash('success', 'Pembayaran jasa ' . $this->jasa->title . ' berhasil');
            $this->dispatch('close-modal', 'confirm-payment');
            $this->redirect(route('bayarJasa', strtolower($servicePay->invoice_number)));
        } else {
            $this->dispatch('notify', message: 'Pembayaran jasa ' . $this->jasa->title . ' gagal', type: 'error');
            $this->dispatch('close-modal', 'confirm-payment');
            return;
        }
    }

    public function updatedTipeKategori()
    {
        $this->isLongDistance = ServiceCategoriesType::where('id', $this->tipeKategori)->first()->name === 'Jarak Jauh';
        $this->kategoriList = ServiceCategories::where('type_id', ServiceCategoriesType::where('id', $this->tipeKategori)->first()->id)->get();
        $this->kategori = "";
        $this->subKategori = "";
        $this->subKategoriList = [];
    }

    public function updatedKategori()
    {
        $kategoriId = ServiceCategories::where('id', $this->kategori)->first()->id;
        $this->subKategoriList = ServiceSubCategories::where('service_category_id', $kategoriId)->get();
        $this->subKategori = "";
    }

    public function updatedProvince()
    {
        $this->regencies = [];
        $this->city = "";
        $this->regencies = DB::table('reg_regencies')->where('province_id', $this->province)->get();
    }

    public function addPackage()
    {
        if (count($this->packages) < 3) {
            $this->packages[] = ['name' => '', 'description' => '', 'duration' => '', 'price' => '', 'revision' => ''];
        }
    }

    public function removePackage($index)
    {
        if (count($this->packages) > 1) {
            unset($this->packages[$index]);
            $this->packages = array_values($this->packages);
        }
    }

    public function addStep()
    {
        if (count($this->steps) < 10) {
            $this->steps[] = [
                'title' => '',
                'placeholder' => 'Cth: Lainnya'
            ];
        }
    }

    public function removeStep($index)
    {
        if (count($this->steps) > 3) {
            unset($this->steps[$index]);
            $this->steps = array_values($this->steps);
        }
    }

    public function addImage()
    {
        if (count($this->images) < 5) {
            $this->images[] = ['file' => null, 'preview' => null];
        }
    }

    public function updatedImages($value, $key)
    {
        $index = explode('.', $key)[0];
        $uploadedFile = $this->images[$index]['file'];

        if ($uploadedFile) {
            $this->images[$index]['preview'] = $uploadedFile->temporaryUrl();
            $this->images[$index]['name'] = $uploadedFile->getClientOriginalName();
            $this->images[$index]['size'] = $uploadedFile->getSize();
        }
    }

    public function formatSize($size)
    {
        if ($size == 0) {
            return 'File tidak ditemukan';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $power = floor(log($size, 1024));
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    public function removeImage($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
        if (count($this->images) == 0) {
            $this->images = [
                ['file' => null, 'preview' => null]
            ];
        }
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // Update jasa
            $this->jasa->update([
                'type_id' => ServiceCategoriesType::where('id', $this->tipeKategori)->first()->id,
                'category_id' => ServiceCategories::where('id', $this->kategori)->first()->id,
                'sub_category_id' => ServiceSubCategories::where('id', $this->subKategori)->first()->id,
                'title' => $this->title,
                'slug' => Str::slug($this->title) . '-' . md5(time()),
                'description' => $this->description,
                'industry' => $this->industry,
                'city' => $this->city,
                'province' => $this->province,
            ]);

            // Update packages
            $this->jasa->prices()->delete();
            foreach ($this->packages as $package) {
                ServicePrice::create([
                    'services_id' => $this->jasa->id,
                    'package_name' => $package['name'],
                    'description' => $package['description'],
                    'duration' => $package['duration'],
                    'price' => $package['price'],
                    'total_revision' => $this->isLongDistance ? $package['revision'] : null
                ]);
            }

            // Update steps
            $this->jasa->steps()->delete();
            foreach ($this->steps as $step) {
                ServiceSteps::create([
                    'services_id' => $this->jasa->id,
                    'step' => $step['title'],
                ]);
            }

            // Update images
            foreach ($this->images as $index => $image) {
                if (isset($image['file'])) {
                    $newName = Str::slug($this->title) . '-' . Str::random(10) . '.' . $image['file']->getClientOriginalExtension();
                    $path = Storage::disk('public')->putFileAs(
                        'assets/img/services',
                        $image['file'],
                        $newName
                    );

                    if (isset($image['id'])) {
                        // Update existing image
                        $serviceImage = $this->jasa->images()->find($image['id']);
                        Storage::disk('public')->delete($serviceImage->image_path);
                        $serviceImage->update(['image_path' => $path]);
                    } else {
                        // Add new image
                        ServiceImages::create([
                            'services_id' => $this->jasa->id,
                            'image_path' => $path,
                            'is_primary' => $index === 0
                        ]);
                    }
                }
            }

            DB::commit();
            session()->flash('success', 'Jasa berhasil diperbarui!');
            return redirect()->route('dashboard.jasa');
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('notify', message: 'Terjadi kesalahan saat memperbarui jasa: ' . $e->getMessage(), type: 'error');
        }
    }

    public function navigate($route)
    {
        return $this->redirect(route($route));
    }

    public function render()
    {
        return view('livewire.dashboard.jasa.edit');
    }
}
