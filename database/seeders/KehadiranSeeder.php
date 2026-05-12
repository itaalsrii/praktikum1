<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KehadiranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
    $karyawan = \App\Models\Karyawan::first();
    if ($karyawan) {
        \App\Models\Kehadiran::create([
            'karyawan_id' => $karyawan->id,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => '08:00:00',
            'jam_keluar' => '17:00:00',
            'status' => 'Hadir'
        ]);
    }
    }
}
