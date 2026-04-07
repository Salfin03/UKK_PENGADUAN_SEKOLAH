<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create(['Id_kategori' => 1, 'ket_kategori' => 'Kebersihan']);
        Kategori::create(['Id_kategori' => 2, 'ket_kategori' => 'Fasilitas']);
        Kategori::create(['Id_kategori' => 3, 'ket_kategori' => 'Keamanan']);
        Kategori::create(['Id_kategori' => 4, 'ket_kategori' => 'Kegiatan Belajar']);
    }
}
