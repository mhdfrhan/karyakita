<?php

namespace App\Livewire\Dashboard\Jasa;

use App\Models\ServiceCategories;
use App\Models\ServiceCategoriesType;
use App\Models\ServiceImages;
use App\Models\ServicePackages;
use App\Models\ServicePrice;
use App\Models\Services;
use App\Models\ServiceSteps;
use App\Models\ServiceSubCategories;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Tambah extends Component
{
    use WithFileUploads;

    public $tipeKategoriList = [], $tipeKategori = "", $kategoriList = [], $kategori = "", $subKategoriList = [], $subKategori = "";
    public $title, $qldeskripsi, $description, $industry, $city, $province;
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
            'images.*.file' => 'required|image|max:2048',
            'steps' => 'required|array|min:3',
            'steps.*.title' => 'required|string|min:5|max:255',
        ];
    }

    protected $messages = [
        'required' => 'Kolom :attribute harus diisi.',
        'min' => 'Kolom :attribute minimal :min karakter.',
        'max' => 'Kolom :attribute maksimal :max karakter.',
        'numeric' => 'Kolom :attribute harus berupa angka.',
        'packages.*.name.required' => 'Nama paket harus diisi.',
        'packages.*.name.min' => 'Nama paket minimal :min karakter.',
        'packages.*.name.max' => 'Nama paket maksimal :max karakter.',
        'packages.*.description.required' => 'Deskripsi paket harus diisi.',
        'packages.*.description.min' => 'Deskripsi paket minimal :min karakter.',
        'packages.*.description.max' => 'Deskripsi paket maksimal :max karakter.',
        'packages.*.duration.required' => 'Durasi pengerjaan harus diisi.',
        'packages.*.duration.numeric' => 'Durasi pengerjaan harus berupa angka.',
        'packages.*.duration.min' => 'Durasi pengerjaan minimal 1 hari.',
        'packages.*.price.required' => 'Harga paket harus diisi.',
        'packages.*.price.numeric' => 'Harga paket harus berupa angka.',
        'packages.*.price.min' => 'Harga paket minimal Rp 1.000',
        'packages.*.revision.required' => 'Total revisi harus diisi.',
        'packages.*.revision.numeric' => 'Total revisi harus berupa angka.',
        'packages.*.revision.min' => 'Total revisi minimal 0.',
        'images.*.file.required' => 'Gambar harus diunggah.',
        'images.*.file.image' => 'File harus berupa gambar.',
        'images.*.file.max' => 'Ukuran gambar maksimal 2MB.',
        'steps.*.title.required' => 'Tahapan kerja wajib diisi',
        'steps.*.title.min' => 'Tahapan kerja minimal 3 karakter',
        'steps.*.title.max' => 'Tahapan kerja maksimal 255 karakter',
    ];

    public function mount()
    {
        $this->tipeKategoriList = ServiceCategoriesType::orderBy('name')->get();
        $this->qldeskripsi = 'quill-' . uniqid();
        $this->provinces = DB::table('reg_provinces')->get();

        $this->packages = [
            ['name' => '', 'description' => '', 'duration' => '', 'price' => '', 'revision' => '']
        ];

        $this->images = [
            ['file' => null, 'preview' => null]
        ];

        $this->steps = [
            ['title' => '', 'placeholder' => 'Cth: Diskusi Konsep'],
            ['title' => '', 'placeholder' => 'Cth: Proses Desain'],
            ['title' => '', 'placeholder' => 'Cth: Pengiriman File Akhir'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedProvince()
    {
        $this->regencies = [];
        $this->city = "";
        $this->regencies = DB::table('reg_regencies')->where('province_id', $this->province)->get();
    }

    public function updatedTipeKategori()
    {
        $this->isLongDistance = ServiceCategoriesType::where('uuid', $this->tipeKategori)->first()->name === 'Jarak Jauh';
        $this->kategoriList = ServiceCategories::where('type_id', ServiceCategoriesType::where('uuid', $this->tipeKategori)->first()->id)->get();
        $this->kategori = "";
        $this->subKategori = "";
        $this->subKategoriList = [];
    }

    public function updatedKategori()
    {
        $kategoriId = ServiceCategories::where('uuid', $this->kategori)->first()->id;
        $this->subKategoriList = ServiceSubCategories::where('service_category_id', $kategoriId)->get();
        $this->subKategori = "";
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


    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $service = Services::create([
                'uuid' => Str::uuid(),
                'shops_id' => auth()->user()->shops->first()->id,
                'type_id' => ServiceCategoriesType::where('uuid', $this->tipeKategori)->first()->id,
                'category_id' => ServiceCategories::where('uuid', $this->kategori)->first()->id,
                'sub_category_id' => ServiceSubCategories::where('uuid', $this->subKategori)->first()->id,
                'title' => $this->title,
                'slug' => Str::slug($this->title) . '-' . md5(time()),
                'description' => $this->description,
                'industry' => $this->industry,
                'city' => $this->city,
                'province' => $this->province,
            ]);

            foreach ($this->packages as $package) {
                ServicePrice::create([
                    'services_id' => $service->id,
                    'package_name' => $package['name'],
                    'description' => $package['description'],
                    'duration' => $package['duration'],
                    'price' => $package['price'],
                    'total_revision' => $this->isLongDistance ? $package['revision'] : null
                ]);
            }

            foreach ($this->steps as $step) {
                ServiceSteps::create([
                    'services_id' => $service->id,
                    'step' => $step['title'],
                    'created_at' => now()
                ]);
            }

            foreach ($this->images as $index => $image) {
                if (isset($image['file'])) {
                    $newName = Str::slug($this->title) . '-' . Str::random(10) . '.' . $image['file']->getClientOriginalExtension();
                    $path = Storage::disk('public')->putFileAs(
                        'assets/img/services',
                        $image['file'],
                        $newName
                    );

                    ServiceImages::create([
                        'services_id' => $service->id,
                        'image_path' => $path,
                        'is_primary' => $index === 0
                    ]);
                }
            }

            DB::commit();
            session()->flash('success', 'Jasa berhasil ditambahkan!');
            return redirect()->route('dashboard.jasa');
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch('notify', message: 'Terjadi kesalahan saat menyimpan jasa ' . $e->getMessage(), type: 'error');
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
        if (count($this->steps) > 1) {
            unset($this->steps[$index]);
            $this->steps = array_values($this->steps);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.jasa.tambah');
    }
}
