<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// TAMBAHKAN BARIS INI:
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Izin extends Model
{
    protected $fillable = ['karyawan_id', 'tipe_izin', 'alasan', 'file_pendukung', 'status'];

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}