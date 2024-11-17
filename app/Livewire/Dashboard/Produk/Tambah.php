<?php

namespace App\Livewire\Dashboard\Produk;

use App\Models\Categories;
use App\Models\ProductFeatures;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\ProductTags;
use App\Models\SubCategories; // Pastikan untuk mengimpor model SubCategories
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Tambah extends Component
{
    use WithFileUploads;

    public $datakategori = [], $kategori = "", $subKategori = "", $subKategoriList = [];
    public $nama, $qldeskripsi, $deskripsi, $halaman, $oldprice, $price, $preview;
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
        'productFile' => 'required|file|mimes:zip,rar,7z|max:512000' // max 500MB
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

    public function formatSize($size)
    {
        if ($size >= 1048576) {
            return round($size / 1048576, 2) . ' MB';
        } elseif ($size >= 1024) {
            return round($size / 1024, 2) . ' KB';
        } else {
            return $size . ' B';
        }
    }

    protected function validateImage($uploadedFile)
    {
        if (!$uploadedFile->isValid() || !in_array($uploadedFile->getMimeType(), ['image/jpeg', 'image/png', 'image/gif'])) {
            $this->dispatch('notify', message: 'File harus berupa gambar valid.', type: 'error');
            return false;
        }
        return true;
    }

    public function removeFeature($index)
    {
        if (count($this->features) > 0) {
            unset($this->features[$index]);
            $this->features = array_values($this->features);
        }
    }

    public function submit()
    {
        // dd(auth()->user()->shops->first()->id);
        // $this->validate();
        // dd($this->temporaryPath);

        try {
            DB::beginTransaction();


            // Generate UUID untuk produk
            $uuid = Str::uuid();

            // Simpan data produk
            $product = Products::create([
                'uuid' => $uuid,
                'shop_id' => auth()->user()->shops->first()->id,
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
                    'product_id' => $product->id,
                    'title' => $feature['title'],
                    'description' => $feature['description']
                ]);
            }

            // Simpan tag produk
            foreach ($this->tags as $tag) {
                ProductTags::create([
                    'name' => $tag,
                    'slug' => Str::slug($tag),
                ]);
            }

            // Simpan gambar produk
            foreach ($this->images as $index => $image) {
                if (isset($image['file'])) {
                    $imageName = Str::random(10) . '.' . $image['file']->getClientOriginalExtension();
                    $path = Storage::disk('public')->putFileAs('products', $image['file'], $imageName);
                    ProductImages::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'is_primary' => $index === 0
                    ]);
                }
            }

            DB::commit();
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

    public function handleFileUpload($fileInfo)
    {
        try {
            $this->isUploading = true;

            // Dapatkan file yang sudah diupload
            $tempFile = $fileInfo['file'];
            $originalName = $fileInfo['name'];
            $fileSize = $fileInfo['size'];

            // Validasi ukuran file (500MB dalam bytes)
            $maxSize = 500 * 1024 * 1024;
            if ($fileSize > $maxSize) {
                throw new \Exception('Ukuran file melebihi 500MB');
            }

            // Pindahkan file ke temporary directory
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $tempPath = 'temp-uploads/' . $tempFile;

            Storage::disk('public')->move($tempFile, $tempPath);

            $this->temporaryPath = $tempPath;
            $this->productFileName = $originalName;
            $this->productFileSize = $this->formatSize($fileSize);

            $this->dispatch('notify', [
                'message' => 'File berhasil diunggah',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'message' => 'Gagal mengunggah file: ' . $e->getMessage(),
                'type' => 'error'
            ]);

            if (isset($tempPath) && Storage::disk('public')->exists($tempPath)) {
                Storage::disk('public')->delete($tempPath);
            }
        } finally {
            $this->isUploading = false;
        }
    }

    public function removeFile()
    {
        try {
            if ($this->temporaryPath) {
                if (!Storage::disk('public')->exists($this->temporaryPath)) {
                    throw new \Exception('File tidak ditemukan');
                }
                Storage::disk('public')->delete($this->temporaryPath);
            }

            $this->reset(['productFile', 'productFileName', 'productFileSize', 'temporaryPath', 'uploadProgress']);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'message' => 'Gagal menghapus file: ' . $e->getMessage(),
                'type' => 'error'
            ]);
        }
    }

    public function dehydrate()
    {
        // Hapus file sementara jika halaman di-refresh
        if ($this->temporaryPath) {
            Storage::disk('public')->delete($this->temporaryPath);
        }
    }

    protected function validateFileType($file)
    {
        $mimeType = $file['type'];
        $allowedTypes = [
            'application/zip',
            'application/x-zip',
            'application/x-zip-compressed',
            'application/x-rar-compressed',
            'application/x-7z-compressed'
        ];

        if (!in_array($mimeType, $allowedTypes)) {
            throw new \Exception('Format file tidak didukung. Gunakan ZIP, RAR, atau 7Z');
        }

        return true;
    }
}
