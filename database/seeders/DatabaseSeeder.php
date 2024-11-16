<?php

namespace Database\Seeders;

use App\Models\Categories;
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
    }
}
