<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\ServiceCategories;
use App\Models\ServiceCategoriesType;
use App\Models\ServiceSubCategories;
use App\Models\Shops;
use App\Models\SubCategories;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \DB::unprepared(file_get_contents(database_path('seeders/wilayah_indonesia.sql')));

        User::factory()->create([
            'name' => 'farhan',
            'email' => 'farhan@gmail.com',
            'username' => 'farhan',
            'phone' => '08123456789',
            'password' => bcrypt('farhan'),
        ]);

        User::factory(50)->create();

        $kategori = [
            'Desain Grafis' => [
                'Desain Logo',
                'Desain Poster',
                'Desain Menu',
                'Desain Produk',
                'Desain Banner',
                'Desain Brosur',
                'Desain Kalender',
                'Desain Vector',
                'Desain Portfolio',
                'Infografis',
                'Template Undangan Digital',
                'Desain Kaos',
                'Desain Kemasan',
                'Template Sosial Media',
                'Ilustrasi',
                'Desain Lainnya',
            ],
            'Web & Aplikasi' => [
                'Aplikasi Android',
                'Aplikasi iOS',
                'Aplikasi Desktop',
                'Aplikasi Mobile',
                'Template Website',
                'Landing Page',
                'Website Toko Online',
                'UI/UX Design',
                'Source Code',
                'Undangan Digital',
                'Web & Aplikasi Lainnya',
            ],
            'Konten Digital' => [
                'E-Book',
                'Video Animasi',
                'Musik & Sound Effects',
                'Template Video',
                'Foto dan Stock Foto',
                'Font dan Icon Pack',
                'Konten Lainnya',
            ],
            'Pendidikan' => [
                'Modul atau Buku Kerja',
                'Tes Latihan',
                'Soal-soal Ujian',
                'Pendidikan Lainnya',
            ],
            'Produktivitas' => [
                'Template Spreadsheet',
                'Template To-Do List',
                'Template Presentasi',
                'Jurnal',
                'Makalah',
                'Alat Manajemen Proyek',
                'Produktivitas Lainnya',
            ]
        ];

        foreach ($kategori as $categoryName => $subcategories) {
            // Create category
            $category = Categories::create([
                'name' => $categoryName,
                'uuid' => Str::uuid(),
                'slug' => Str::slug($categoryName),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create subcategories
            foreach ($subcategories as $subcategoryName) {
                SubCategories::create([
                    'category_id' => $category->id,
                    'uuid' => Str::uuid(),
                    'name' => $subcategoryName,
                    'slug' => Str::slug($subcategoryName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Shops::create([
            'user_id' => 1,
            'name' => 'Farhan Store',
            'description' => 'Farhan',
            'city' => 'Pekanbaru',
            'province' => 'Riau',
            'country' => 'Indonesia',
            'postal_code' => '28293',
            'address' => 'Jl. Raya Pekanbaru No. 1',
        ]);

        $tipeKategori = [
            'Jarak Jauh' => [
                'Desain Grafis & Branding' => [
                    'Desain Logo',
                    'Desain Poster',
                    'Desain Baju',
                    'Desain Arsitek Rumah',
                    'Desain Banner/Billboard',
                    'Desain Booth',
                    'Desain Kemasan',
                    'Desain Brosur/Flyer',
                    'Desain Buku',
                    'Desain Undangan',
                    'Desain Ruangan',
                    'Desain Infografis',
                    'Desain Kalender',
                    '3D & Perspektif',
                    '3D Printing',
                    '3D Animation',
                    'Desain Lainnya',
                ],
                'Website & Pemrograman' => [
                    'Website Personal',
                    'Website Perusahaan',
                    'Aplikasi Web',
                    'Aplikasi Mobile',
                    'Pemrograman Khusus',
                    'UI/UX Design',
                    'Manajemen Database',
                    'Pembuatan CMS',
                    'Pengembangan API',
                    'Pemeliharaan Website',
                    'Pembuatan E-Commerce',
                    'Pembuatan Sistem Informasi',
                    'Pengetesan Perangkat Lunak',
                    'Website & Pemrograman Lainnya',
                ],
                'Video, Fotografi, & Audio' => [
                    'Video Editing',
                    'Motion Graphics',
                    'Animasi 2D',
                    'Animasi 3D',
                    'Video Promosi',
                    'Video Tutorial',
                    'Pembuatan Trailer',
                    'Video Dokumentasi',
                    'Foto Produk',
                    'Foto Pemandangan',
                    'Foto Potret',
                    'Foto Dokumentasi',
                    'Editing Foto',
                    'Pembuatan Musik',
                    'Perekaman Suara',
                    'Mixing & Mastering',
                    'Jingle & Lagu',
                    'Podcast Editing',
                    'Video, Fotografi, & Audio Lainnya',
                ],
                'Penulisan & Karya Ilmiah' => [
                    'Artikel',
                    'Blog',
                    'Cerita Pendek',
                    'Penulisan Buku',
                    'Esai',
                    'Karya Ilmiah',
                    'Laporan Penelitian',
                    'Penulisan & Karya Ilmiah Lainnya',
                ],
                'Pemasaran & Periklanan' => [
                    'Desain Iklan',
                    'Manajemen Media Sosial',
                    'Pemasaran Email',
                    'Pembuatan Konten',
                    'SEO & SEM',
                    'Strategi Pemasaran',
                    'Pemasaran Lainnya',
                ],
            ],
            'Jarak Dekat' => [
                'Mekanik' => [
                    'Servis Motor',
                    'Servis Mobil',
                    'Perbaikan Mesin Industri',
                    'Instalasi dan Pemeliharaan AC',
                    'Pengelasan',
                    'Mekanik Lainnya',
                ],
                'Kesehatan' => [
                    'Pemeriksaan Kesehatan Umum',
                    'Fisioterapi',
                    'Pijat Tradisional',
                    'Konsultasi Gizi',
                    'Perawatan Lansia',
                    'Tes Laboratorium',
                    'Layanan Kesehatan Lainnya',
                ],
                'Konstruksi' => [
                    'Pembangunan Rumah',
                    'Renovasi Bangunan',
                    'Instalasi Listrik',
                    'Instalasi Pipa',
                    'Perbaikan Atap',
                    'Konstruksi Lainnya',
                ],
                'Pendidikan' => [
                    'Les Privat',
                    'Bimbingan Belajar',
                    'Kursus Bahasa',
                    'Pelatihan Komputer',
                    'Pendidikan Lainnya',
                ],
                'Transportasi' => [
                    'Jasa Pengangkutan Barang',
                    'Sewa Kendaraan',
                    'Jasa Pindahan',
                    'Transportasi Lainnya',
                ],
                'Pekerjaan Rumah Tangga' => [
                    'Cleaning Service',
                    'Penyemprotan Hama',
                    'Perbaikan Peralatan Rumah Tangga',
                    'Pekerjaan Rumah Tangga Lainnya',
                ],
                'Lainnya' => [
                    'Jasa Kurir Lokal',
                    'Jasa Event Organizer',
                    'Jasa Dekorasi Acara',
                    'Layanan Lainnya',
                ],
            ],
        ];

        // Loop tipe kategori (Jarak Jauh dan Jarak Dekat)
        foreach ($tipeKategori as $typeName => $categories) {
            $type = ServiceCategoriesType::create([
                'name' => $typeName,
                'uuid' => Str::uuid(),
                'slug' => Str::slug($typeName),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Loop service categories
            foreach ($categories as $categoryName => $subcategories) {
                $serviceCategory = ServiceCategories::create([
                    'type_id' => $type->id,
                    'name' => $categoryName,
                    'uuid' => Str::uuid(),
                    'slug' => Str::slug($categoryName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Loop service subcategories
                foreach ($subcategories as $subcategoryName) {
                    ServiceSubCategories::create([
                        'service_category_id' => $serviceCategory->id,
                        'name' => $subcategoryName,
                        'uuid' => Str::uuid(),
                        'slug' => Str::slug($subcategoryName),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
