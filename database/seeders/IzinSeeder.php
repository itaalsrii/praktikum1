<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IzinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Ambil ID karyawan yang tadi sudah dibuat (Muflih Anwar)
    $karyawan = \App\Models\Karyawan::where('nik', '220101')->first();

    if ($karyawan) {
        \App\Models\Izin::create([
            'karyawan_id' => $karyawan->id,
            'tipe_izin' => 'Sakit',
            'alasan' => 'Demam tinggi',
            'file_pendukung' => 'surat_dokter.pdf',
            'status' => 'pending'
        ]);
    }
}
}
