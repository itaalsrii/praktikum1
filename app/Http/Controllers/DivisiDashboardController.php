<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Izin;
use Illuminate\Http\Request;

class DivisiDashboardController extends Controller
{
    // Halaman Dashboard Utama
    public function index()
{
    // 1. Data Statistik (Card)
    $totalKaryawan = \App\Models\Karyawan::count();
    $hariIni = now()->toDateString();
    
    $hadir = \App\Models\Kehadiran::where('tanggal', $hariIni)->where('status', 'Hadir')->count();
    $terlambat = \App\Models\Kehadiran::where('tanggal', $hariIni)->where('status', 'Terlambat')->count();
    
    $sudahAbsen = \App\Models\Kehadiran::where('tanggal', $hariIni)->count();
    $alpha = $totalKaryawan - $sudahAbsen;

    $totalIzin = \App\Models\Izin::where('tipe_izin', 'Izin')->where('status', 'pending')->count();
    $totalSakit = \App\Models\Izin::where('tipe_izin', 'Sakit')->where('status', 'pending')->count();

    // 2. Data untuk Grafik (WAJIB ADA AGAR TIDAK ERROR $labels)
    $labels = [];
    $dataHadir = [];

    // Mengambil data 7 hari terakhir
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i)->toDateString();
        $labels[] = now()->subDays($i)->format('D'); // Nama hari (Sen, Sel, dst)
        $dataHadir[] = \App\Models\Kehadiran::where('tanggal', $date)->where('status', 'Hadir')->count();
    }

    // 3. Kirim SEMUA variabel ke view
    return view('divisi.dashboard', compact(
        'totalKaryawan', 
        'hadir', 
        'terlambat', 
        'alpha', 
        'totalIzin', 
        'totalSakit',
        'labels',    // Pastikan ini tertulis
        'dataHadir'  // Pastikan ini tertulis
    ));
}

    // Halaman Data Karyawan dengan Fitur Search & Filter
    public function karyawan(Request $request)
    {
        $query = Karyawan::query();

        // Fitur Cari NIK/Nama
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nik', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_karyawan', 'like', '%' . $request->search . '%');
            });
        }

        // Fitur Filter L/P
        if ($request->filled('gender')) {
            $query->where('jenis_kelamin', $request->gender);
        }

        // Fitur Filter Jabatan
        if ($request->filled('jabatan')) {
            $query->where('jabatan', $request->jabatan);
        }

        $karyawans = $query->get();
        return view('divisi.DataKaryawanDivisi', compact('karyawans'));
    }
    

    // Halaman Verifikasi Perizinan
        public function perizinan()
        {
            $izins = Izin::with('karyawan')->where('status', 'pending')->get();
            return view('divisi.verifikasiPerizinan', compact('izins'));
        }
        public function kehadiran(Request $request)
{
    // Mengambil data kehadiran beserta data karyawannya
    $query = \App\Models\Kehadiran::with('karyawan');

    // Fitur Pencarian berdasarkan Nama atau NIK Karyawan
    if ($request->filled('search')) {
        $query->whereHas('karyawan', function($q) use ($request) {
            $q->where('nama_karyawan', 'like', '%' . $request->search . '%')
              ->orWhere('nik', 'like', '%' . $request->search . '%');
        });
    }

    // Filter berdasarkan Jabatan
    if ($request->filled('jabatan')) {
        $query->whereHas('karyawan', function($q) use ($request) {
            $q->where('jabatan', $request->jabatan);
        });
    }

    $kehadirans = $query->get();
    return view('divisi.DataKehadiran', compact('kehadirans'));
}
}
