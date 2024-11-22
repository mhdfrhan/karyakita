<?php

namespace App\Livewire\Dashboard\Produk;

use App\Models\Advertisements;
use App\Models\Categories;
use App\Models\ProductTags;
use App\Models\ProductVersion;
use App\Models\SubCategories;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $produk, $datakategori = [], $kategori = "", $subKategori = "", $subKategoriList = [];
    public $nama, $qldeskripsi, $deskripsi, $value, $halaman, $oldprice, $price, $preview, $version, $productAds;
    public $features = [];
    public $images = [];
    public $tags = [];
    public $tagInput = '';
    public $uploadProgress = 0;
    public $isUploading = false;
    public $uploadFile = false;

    protected $rules = [
        'kategori' => 'required',
        'subKategori' => 'required',
        'nama' => 'required|min:10|max:50',
        'deskripsi' => 'required|min:20|max:150',
        'features.*.title' => 'required|min:5|max:50',
        'features.*.description' => 'required|min:20|max:150',
        'images.*.file' => 'nullable|image|max:2048',
        'halaman' => 'required|numeric',
        'oldprice' => 'required|numeric',
        'price' => 'required|numeric',
        'preview' => 'nullable',
        'tags' => 'array|max:5',
        'tags.*' => 'required|min:3|max:10',
        'version' => 'nullable|numeric',
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
        'oldprice.numeric' => 'Harga lama harus berupa angka.',
        'price.numeric' => 'Harga harus berupa angka.',
        'tags.max' => 'Maksimal 5 tag yang diperbolehkan.',
        'version.numeric' => 'Versi produk harus berupa angka.',
    ];

    public function mount()
    {
        $this->nama = $this->produk->name;
        $this->kategori = $this->produk->category->uuid;
        $this->subKategori = $this->produk->subCategory->uuid;
        $this->deskripsi = $this->produk->description;
        $this->preview = $this->produk->preview_url;
        $this->halaman = $this->produk->pages;
        $this->oldprice = $this->produk->old_price;
        $this->price = $this->produk->price;
        $this->value = $this->produk->description;

        // Load tags
        $tagIds = explode(',', $this->produk->tags);
        $this->tags = ProductTags::whereIn('id', $tagIds)
            ->pluck('name')
            ->toArray();

        // Load features
        $this->features = $this->produk->features->map(function ($feature) {
            return [
                'title' => $feature->title,
                'description' => $feature->description
            ];
        })->toArray();

        // Load images dengan pengecekan file
        $this->images = $this->produk->images->map(function ($image) {
            $filePath = $image->image_path;
            $fileExists = Storage::exists($filePath);

            return [
                'file' => null,
                'preview' => $fileExists ? Storage::url($image->image_path) : null,
                'name' => basename($image->image_path),
                'size' => $fileExists ? Storage::size($filePath) : 0,
                'id' => $image->id
            ];
        })->toArray();

        $this->datakategori = Categories::orderBy('name')->get();
        $this->qldeskripsi = 'quill-' . uniqid();
    }

    public function updated($propertyName)
    {
        if ($this->produk->admin_approved == 0) {
            $this->dispatch('notify', message: 'Produk belum disetujui oleh admin!', type: 'error');
            return;
        } elseif ($this->produk->admin_approved == -1) {
            $this->dispatch('notify', message: 'Produk ditolak oleh admin!', type: 'error');
            return;
        }

        $this->validateOnly($propertyName);

        $isFilled = !empty($this->kategori)
            && !empty($this->subKategori)
            && !empty($this->nama)
            && !empty($this->deskripsi)
            && !empty($this->halaman)
            && !empty($this->oldprice)
            && !empty($this->price)
            && !empty($this->tags)
            && !empty($this->features)
            && !empty($this->images);

        $this->uploadFile = $isFilled;
    }

    public function render()
    {
        return view('livewire.dashboard.produk.edit', [
            'kategoriList' => $this->datakategori,
            'subKategoriList' => $this->subKategoriList,
        ]);
    }

    public function addTag()
    {
        if ($this->produk->admin_approved <= 0) {
            return;
        }

        if (!empty($this->tagInput) && count($this->tags) < 5) {
            $this->tags[] = $this->tagInput;
            $this->tagInput = '';
        }
    }

    public function removeTag($index)
    {
        if ($this->produk->admin_approved <= 0) {
            return;
        }

        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);
    }

    public function addFeature()
    {
        if ($this->produk->admin_approved <= 0) {
            return;
        }
        if (count($this->features) < 5) {
            $this->features[] = ['title' => '', 'description' => ''];
        }
    }

    public function removeFeature($index)
    {
        if ($this->produk->admin_approved <= 0) {
            return;
        }

        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function addImage()
    {
        if ($this->produk->admin_approved <= 0) {
            return;
        }

        if (count($this->images) < 10) {
            $this->images[] = ['file' => null, 'preview' => null, 'name' => null, 'size' => null];
        }
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

    public function formatSize($size)
    {
        if ($size == 0) {
            return 'File tidak ditemukan';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $power = floor(log($size, 1024));
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    public function submit()
    {
        if ($this->produk->admin_approved == 0) {
            $this->dispatch('notify', message: 'Produk belum disetujui oleh admin!', type: 'error');
            return;
        } elseif ($this->produk->admin_approved == -1) {
            $this->dispatch('notify', message: 'Produk ditolak oleh admin!', type: 'error');
            return;
        }

        if ($this->produk->admin_approved <= 0) {
            return;
        }

        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->dispatch('notify', message: $e->validator->errors()->first(), type: 'error');
            return;
        }

        try {
            DB::beginTransaction();

            // Update produk
            $this->produk->update([
                'name' => $this->nama,
                'category_id' => Categories::where('uuid', $this->kategori)->first()->id,
                'sub_category_id' => SubCategories::where('uuid', $this->subKategori)->first()->id,
                'description' => $this->deskripsi,
                'preview_url' => $this->preview,
                'pages' => $this->halaman,
                'old_price' => $this->oldprice,
                'price' => $this->price,
            ]);

            // Update tags
            $tagIds = [];
            foreach ($this->tags as $tag) {
                $tag = strtolower(trim($tag));
                $productTag = ProductTags::firstOrCreate(
                    ['slug' => Str::slug($tag)],
                    ['name' => $tag]
                );
                $tagIds[] = $productTag->id;
            }
            $this->produk->tags = implode(',', $tagIds);
            $this->produk->save();

            // Update features
            $this->produk->features()->delete();
            foreach ($this->features as $feature) {
                $this->produk->features()->create($feature);
            }

            // Update images
            foreach ($this->images as $index => $image) {
                if (isset($image['file'])) {
                    $path = Storage::disk('public')->putFile(
                        'assets/img/products',
                        $image['file']
                    );

                    if (isset($image['id'])) {
                        // Update existing image
                        $productImage = $this->produk->images()->find($image['id']);
                        Storage::disk('public')->delete($productImage->image_path);
                        $productImage->update(['image_path' => $path]);
                    } else {
                        // Add new image
                        $this->produk->images()->create(['image_path' => $path]);
                    }
                }
            }

            // tambahkan versi baru jika ada
            if (!empty($this->version) && Session::has('file_path')) {
                $originalFileName = basename(Session::get('file_path'));
                $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
                $newName = Str::slug($this->nama) . '-' . 'v' . $this->version . '-' . md5(time()) . '.' . $extension;

                $newPath = 'products/' . $newName;
                $moveResult = Storage::disk('public')->move(Session::get('file_path'), $newPath);

                if ($moveResult) {
                    ProductVersion::create([
                        'products_id' => $this->produk->id,
                        'version' => $this->version,
                        'file_path' => $newPath,
                        'created_at' => now(),
                    ]);
                }
            }

            DB::commit();

            Session::forget('file_path');
            session()->flash('message', 'Produk berhasil diperbarui');
            return redirect()->route('dashboard.produk');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updatedProductAds()
    {
        $this->validate([
            'productAds' => 'required|in:15,20,30'
        ], [
            'productAds.required' => 'Pilih durasi pembayaran',
            'productAds.in' => 'Durasi pembayaran tidak valid'
        ]);
    }

    // membuat iklan baru
    public function submitPayment()
    {
        $this->validate([
            'productAds' => 'required|in:15,20,30'
        ], [
            'productAds.required' => 'Pilih durasi pembayaran',
            'productAds.in' => 'Durasi pembayaran tidak valid'
        ]);

        if ((int)$this->productAds == 15) {
            $amount = 30000;
        } elseif ((int)$this->productAds == 20) {
            $amount = 50000;
        } elseif ((int)$this->productAds == 30) {
            $amount = 75000;
        } else {
            $this->dispatch('notify', message: 'Durasi pembayaran tidak valid', type: 'error');
            return;
        }

        try {
            if ($this->produk->ads && $this->produk->ads->first()) {
                $currentAds = $this->produk->ads->first();

                if ($currentAds->end_date < now() || $currentAds->snap_token === null) {
                    $currentAds->delete();
                }

                foreach ($this->produk->ads as $ads) {
                    if ($ads->status == 'pending') {
                        $ads->delete();
                    }
                }
            }
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: "Terjadi kesalahan", type: 'error');
            return;
        }

        try {
            $ads = Advertisements::create([
                'invoice_number' => 'PRODUK-' . uniqid(),
                'shops_id' => $this->produk->shops_id,
                'products_id' => $this->produk->id,
                'start_date' => now(),
                'end_date' => now()->addDays((int)$this->productAds),
                'price' => $amount,
                'created_at' => now(),
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('close-modal', 'confirm-payment');
            $this->dispatch('notify', message: "Terjadi kesalahan saat membuat iklan " . $th->getMessage(), type: 'error');
            return;
        }

        $this->dispatch('close-modal', 'confirm-payment');
        Session::flash('success', 'Iklan berhasil dibuat!');
        return redirect()->route('bayarProduk', strtolower($ads->invoice_number));
    }

    public function isProductApproved()
    {
        return $this->produk->admin_approved == 1;
    }
}
