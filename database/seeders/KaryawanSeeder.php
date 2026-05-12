<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\Karyawan::create([
        'nik' => '220101',
        'nama_karyawan' => 'Muflih Anwar',
        'email' => 'muflih@example.com', // Tambahkan ini
        'password' => bcrypt('password123'), // Tambahkan ini
        'divisi' => 'HRD',
        'jabatan' => 'Staff',
        'jenis_kelamin' => 'L',
        'status' => 'Aktif',
        'role' => 'User'
    ]);
    }
}
