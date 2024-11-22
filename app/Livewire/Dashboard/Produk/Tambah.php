<?php

namespace App\Livewire\Dashboard\Produk;

use App\Models\Categories;
use App\Models\ProductFeatures;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\ProductTags;
use App\Models\ProductVersion;
use App\Models\SubCategories; // Pastikan untuk mengimpor model SubCategories
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Tambah extends Component
{
    use WithFileUploads;

    public $datakategori = [], $kategori = "", $subKategori = "", $subKategoriList = [];
    public $nama, $qldeskripsi, $deskripsi, $halaman, $oldprice, $price, $preview, $version;
    public $features = [];
    public $images = [];
    public $tags = [];
    public $tagInput = '';
    public $productFile;
    public $productFileName;
    public $productFileSize;
    public $uploadProgress = 0;
    public $isUploading = false;
    public $temporaryPath = null;
    public $uploadFile = false;

    protected $rules = [
        'kategori' => 'required',
        'subKategori' => 'required',
        'nama' => 'required|min:10|max:50',
        'deskripsi' => 'required|min:20|max:150',
        'features.*.title' => 'required|min:5|max:50',
        'features.*.description' => 'required|min:20|max:150',
        'images.*.file' => 'required|image|max:2048',
        'halaman' => 'required|numeric',
        'oldprice' => 'required|numeric',
        'price' => 'required|numeric',
        'preview' => 'nullable',
        'tags' => 'array|max:5',
        'tags.*' => 'required|min:3|max:10',
        'version' => 'required|numeric',
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
        'productFile.required' => 'File produk harus diunggah.',
        'productFile.max' => 'Ukuran file produk maksimal :max KB.',
        'version.required' => 'Versi produk harus diisi.',
        'version.numeric' => 'Versi produk harus berupa angka.',
    ];

    public function updated($propertyName)
    {
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


    public function updatedKategori()
    {
        $kategoriId = Categories::where('uuid', $this->kategori)->pluck('id')->first();
        if (!$kategoriId) {
            $this->subKategoriList = [];
        }
        $this->subKategoriList = SubCategories::where('category_id', $kategoriId)->get();
        $this->subKategori = "";
    }

    public function updatedPrice()
    {
        if ($this->oldprice < $this->price) {
            $this->dispatch('notify', message: 'Harga lama tidak boleh lebih kecil dari harga baru', type: 'error');
            $this->price = $this->oldprice - 1;
            return;
        }
    }

    public function addTag()
    {
        $tag = trim($this->tagInput);
        if (!empty($tag) && count($this->tags) < 5) {
            if (!in_array($tag, $this->tags)) {
                $this->tags[] = $tag;
                $this->tagInput = '';
            } else {
                $this->dispatch('notify', message: 'Tag sudah ada!', type: 'error');
            }
        } elseif (count($this->tags) >= 5) {
            $this->dispatch('notify', message: 'Maksimal 5 tag yang diperbolehkan!', type: 'error');
        }
    }

    public function removeTag($index)
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);
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
            $this->images[] = ['file' => null, 'preview' => null, 'name' => '', 'size' => ''];
        }
    }

    public function updatedImages($value, $key)
    {
        $index = explode('.', $key)[0];
        $uploadedFile = $this->images[$index]['file'];

        if ($uploadedFile) {
            $this->images[$index]['preview'] = $uploadedFile->temporaryUrl();
            $this->images[$index]['name'] = $uploadedFile->getClientOriginalName();
            $this->images[$index]['size'] = $uploadedFile->getSize(); // Ukuran dalam bytes
        }
    }

    public function removeFeature($index)
    {
        if (count($this->features) > 0) {
            unset($this->features[$index]);
            $this->features = array_values($this->features);
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

        try {
            DB::beginTransaction();


            // Generate UUID untuk produk
            $uuid = Str::uuid();

            try {
                // Simpan data produk
                $product = Products::create([
                    'uuid' => $uuid,
                    'shops_id' => auth()->user()->shops->first()->id,
                    'category_id' => Categories::where('uuid', $this->kategori)->first()->id,
                    'slug' => Str::slug($this->nama),
                    'sub_category_id' => SubCategories::where('uuid', $this->subKategori)->first()->id,
                    'name' => $this->nama,
                    'description' => $this->deskripsi,
                    'preview_url' => $this->preview,
                    'pages' => $this->halaman,
                    'old_price' => $this->oldprice,
                    'price' => $this->price,
                    'status' => 'published'
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                $this->dispatch('notify', message: 'Terjadi kesalahan saat menyimpan produk', type: 'error');
                return;
            }

            // Jika ada file yang diupload, pindahkan dari temporary ke lokasi permanen
            if ($this->temporaryPath) {
                $permanentPath = 'products/' . basename($this->temporaryPath);
                Storage::disk('public')->move($this->temporaryPath, $permanentPath);

                // Simpan path file di database
                $product->file_path = $permanentPath;
            }

            // Simpan fitur produk
            foreach ($this->features as $feature) {
                ProductFeatures::create([
                    'products_id' => $product->id,
                    'title' => $feature['title'],
                    'description' => $feature['description']
                ]);
            }

            $tagIds = [];

            foreach ($this->tags as $tag) {
                $normalizedTag = strtolower(trim($tag));

                if (!ProductTags::where('slug', Str::slug($normalizedTag))->exists()) {
                    $productTag = ProductTags::create([
                        'name' => strtolower($tag),
                        'slug' => Str::slug($normalizedTag),
                    ]);

                    $tagIds[] = $productTag->id;
                } else {
                    $existingTag = ProductTags::where('slug', Str::slug($normalizedTag))->first();
                    $tagIds[] = $existingTag->id;
                }
            }

            $product->tags = implode(',', $tagIds);
            $product->save();

            // Simpan gambar produk
            foreach ($this->images as $index => $image) {
                if (isset($image['file'])) {
                    $imageName = Str::random(10) . '.' . $image['file']->getClientOriginalExtension();
                    $path = Storage::disk('public')->putFileAs('assets/img/products', $image['file'], $imageName);
                    ProductImages::create([
                        'products_id' => $product->id,
                        'image_path' => $path,
                        'is_primary' => $index === 0
                    ]);
                }
            }

            $originalFileName = basename(Session::get('file_path'));
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $newName = Str::slug($this->nama) . '-' . 'v' . $this->version . '-' . md5(time()) . '.' . $extension;

            $newPath = 'products/' . $newName; // Tentukan path baru secara manual
            $moveResult = Storage::disk('public')->move(Session::get('file_path'), $newPath); // Pindahkan file

            if ($moveResult) {
                ProductVersion::create([
                    'products_id' => $product->id,
                    'version' => $this->version,
                    'file_path' => $newPath, // Gunakan path baru di database
                    'created_at' => now(),
                ]);
            }

            DB::commit();
            Session::forget('file_path');
            session()->flash('success', 'Produk berhasil ditambahkan!');
            return redirect()->route('dashboard.produk');
        } catch (\Exception $e) {
            DB::rollBack();
            if ($this->temporaryPath) {
                Storage::disk('public')->delete($this->temporaryPath);
            }
            throw $e;
            $this->dispatch('notify', message: $e->getMessage(), type: 'error');
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
