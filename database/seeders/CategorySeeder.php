<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Biaya Pendidikan', // UKT, SPP, uang gedung
            'Buku & Alat Belajar', // Buku, fotokopi, alat tulis
            'Penelitian & Skripsi', // Kebutuhan riset, sidang, dll
            'Biaya Kost & Hidup', // Uang sewa, makan, tagihan
            'Kesehatan & Medis', // Biaya berobat, obat-obatan
            'Perangkat Belajar', // Laptop, HP, atau perbaikan
            'Lain-lain', // Kategori umum
        ];

        foreach ($categories as $categoryName) {
            // firstOrCreate akan mencari data terlebih dahulu, jika belum ada baru akan dibuat.
            // Ini mencegah data duplikat jika seeder dijalankan berkali-kali.
            Category::firstOrCreate([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);
        }

        // Memberikan feedback di terminal bahwa seeder berhasil dijalankan
        $this->command->info('Category Seeder has been run successfully!');
    }
}
