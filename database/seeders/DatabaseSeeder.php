<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'Username' => 'admin',
            'password' => Hash::make('password')
        ]);

        Siswa::create([
            'nis' => 1234567890,
            'kelas' => 'XII RPL 1',
        ]);
    }
}
