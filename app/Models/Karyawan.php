<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    // Nama tabel di database
    protected $table = 'karyawans'; 

    // Kolom yang boleh diisi
    protected $fillable = [
        'nik', 
        'nama_karyawan', 
        'email', 
        'password', 
        'divisi', 
        'jabatan', 
        'jenis_kelamin', 
        'status', 
        'role'
    ];
}