<?php

namespace App\Livewire\Dashboard\Produk;

use App\Models\Categories;
use App\Models\SubCategories; // Pastikan untuk mengimpor model SubCategories
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Tambah extends Component
{
    use WithFileUploads;

    public $datakategori = [], $kategori = "", $subKategori = "", $subKategoriList = [];
    public $nama, $qldeskripsi, $deskripsi, $halaman;
    public $features = [];
    public $images = [];

    protected $rules = [
        'kategori' => 'required',
        'subKategori' => 'required',
        'nama' => 'required|min:10|max:50',
        'deskripsi' => 'required|min:20|max:150',
        'features.*.title' => 'required|min:5|max:50',
        'features.*.description' => 'required|min:20|max:150',
        'images.*.file' => 'required|image|max:2048',
        'halaman' => 'required|numeric',
    ];

    protected $messages = [
        'required' => 'Kolom :attribute harus diisi.',
        'min' => 'Kolom :attribute minimal :min karakter.',
        'max' => 'Kolom :attribute maksimal :max karakter.',
        'features.*.title.required' => 'Judul fitur harus diisi.',
        'features.*.title.min' => 'Judul fitur minimal :min karakter.',
        'features.*.title.max' => 'Judul fitur maksimal :max karakter.',
        'features.*.description.required' => 'Deskripsi fitur harus diisi.',
        'features.*.description.min' => 'Deskripsi fitur minimal :min karakter.',
        'features.*.description.max' => 'Deskripsi fitur maksimal :max karakter.',
        'images.*.file.required' => 'Gambar harus diunggah.',
        'images.*.file.image' => 'File harus berupa gambar.',
        'images.*.file.max' => 'Ukuran gambar maksimal 2MB.',
        'halaman.numeric' => 'Halaman harus berupa angka.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedKategori()
    {
        $kategoriId = Categories::where('uuid', $this->kategori)->pluck('id')->first();
        if (!$kategoriId) {
            $this->subKategoriList = [];
        }
        $this->subKategoriList = SubCategories::where('category_id', $kategoriId)->get();
        $this->subKategori = "";
    }

    public function mount()
    {
        $this->datakategori = Categories::orderBy('name')->get();
        $this->qldeskripsi = 'quill-' . uniqid();

        $this->features = [
            ['title' => '', 'description' => ''],
        ];

        $this->images = [
            ['file' => null, 'preview' => null]
        ];
    }

    public function addFeature()
    {
        if (count($this->features) < 5) {
            $this->features[] = ['title' => '', 'description' => ''];
        }
    }

    public function addImage()
    {
        if (count($this->images) < 10) {
            $this->images[] = ['file' => null, 'preview' => null];
        }
    }

    public function removeFeature($index)
    {
        if (count($this->features) > 0) {
            unset($this->features[$index]);
            $this->features = array_values($this->features);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.produk.tambah', [
            'kategoriList' => $this->datakategori,
            'subKategoriList' => $this->subKategoriList,
        ]);
    }
}
