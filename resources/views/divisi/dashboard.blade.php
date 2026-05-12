@extends('layouts.admin')

@section('content')
<style>
    .banner-welcome { background: #d3d3d3; padding: 30px; border-radius: 12px; margin-bottom: 20px; position: relative; }
    .clock-container { position: absolute; right: 30px; top: 20px; text-align: right; }
    /* Style untuk jam besar */
    .clock-text { font-size: 3.5rem; font-weight: bold; line-height: 1; color: #000; }
    /* Style untuk detik (kecil di atas) */
    .clock-sec { font-size: 1.2rem; vertical-align: top; margin-left: 2px; }
    
    .stat-card { background: #d3d3d3; border-radius: 8px; padding: 10px; text-align: center; border: none; }
    .stat-label { font-size: 0.75rem; font-weight: bold; margin-bottom: 5px; display: block; }
    .stat-number { font-size: 2.2rem; font-weight: bold; color: #000; line-height: 1; }
    .shortcut-section { background: #d3d3d3; border-radius: 12px; padding: 20px; height: 100%; }
    .btn-shortcut { background: #fff; border-radius: 10px; padding: 15px; text-decoration: none; color: #000; font-weight: bold; text-align: center; display: block; border: none; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: 0.2s; }
    .btn-shortcut:hover { background: #f8f9fa; transform: translateY(-2px); }
    .btn-shortcut i { font-size: 2rem; display: block; margin-bottom: 5px; }
</style>

<div class="p-3">
    <div class="banner-welcome">
        <div class="w-75">
            <h2 class="fw-bold">Selamat Datang di Divisi Marketing</h2>
            <p class="text-muted small">Menjadi penggerak utama pertumbuhan perusahaan dengan membangun citra merek yang kuat, menjangkau pasar yang lebih luas, dan menciptakan hubungan jangka panjang dengan pelanggan.</p>
        </div>
        <div class="clock-container">
            <div class="clock-text">
                <span id="txt-jam">00</span> : <span id="txt-menit">00</span><span class="clock-sec" id="txt-detik">00</span>
            </div>
            <div class="fw-bold mt-1" id="txt-tanggal">Memuat Tanggal...</div>
        </div>
    </div>

    <div class="row text-center mb-4">
        <div class="col-md-2">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Total Karyawan</small>
                <h2 class="fw-bold">{{ $totalKaryawan }}</h2>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Hadir</small>
                <h2 class="fw-bold">{{ $hadir }}</h2>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Terlambat</small>
                <h2 class="fw-bold">{{ $terlambat }}</h2>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Alpha</small>
                <h2 class="fw-bold">{{ $alpha }}</h2>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Izin</small>
                <h2 class="fw-bold">{{ $totalIzin }}</h2>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card shadow-sm p-3">
                <small class="text-muted">Sakit</small>
                <h2 class="fw-bold">{{ $totalSakit }}</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="p-3 border rounded bg-white" style="height: 350px;">
                <p class="fw-bold small mb-2">Grafik Absensi</p>
                <div style="position: relative; height: 280px; width: 100%;">
                    <canvas id="absensiChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="shortcut-section">
                <p class="fw-bold mb-3">Jalan Pintas:</p>
                <div class="row g-2">
                    <div class="col-6">
                        <a href="{{ route('divisi.karyawan') }}" class="btn-shortcut">
                            <i class="bi bi-people-fill"></i> Karyawan
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('divisi.kehadiran') }}" class="btn-shortcut">
                            <i class="bi bi-calendar-check-fill"></i> Monitoring
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="{{ route('divisi.perizinan') }}" class="btn-shortcut d-flex align-items-center justify-content-center gap-3">
                            <i class="bi bi-file-earmark-text-fill mb-0"></i> Verifikasi Perizinan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // --- SCRIPT JAM BERJALAN ---
    function updateWaktu() {
        const sekarang = new Date();
        const jam = String(sekarang.getHours()).padStart(2, '0');
        const menit = String(sekarang.getMinutes()).padStart(2, '0');
        const detik = String(sekarang.getSeconds()).padStart(2, '0');

        document.getElementById('txt-jam').innerText = jam;
        document.getElementById('txt-menit').innerText = menit;
        document.getElementById('txt-detik').innerText = detik;

        const options = { weekday: 'long', day: 'numeric', month: 'short', year: 'numeric' };
        const tanggal = sekarang.toLocaleDateString('id-ID', options);
        document.getElementById('txt-tanggal').innerText = tanggal;
    }

    setInterval(updateWaktu, 1000);
    updateWaktu();

    // --- SCRIPT GRAFIK ABSENSI ---
    const ctx = document.getElementById('absensiChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Hadir', 'Terlambat', 'Alpha', 'Izin', 'Sakit'],
            datasets: [{
                label: 'Jumlah',
                data: [
                    {{ $hadir }}, 
                    {{ $terlambat }}, 
                    {{ $alpha }}, 
                    {{ $totalIzin }}, 
                    {{ $totalSakit }}
                ],
                backgroundColor: [
                    '#212529', // Dark (Hadir/Hampir mirip desain Anda)
                    '#6c757d', // Grey (Terlambat)
                    '#212529', // Dark (Alpha)
                    '#6c757d', // Grey (Izin)
                    '#212529'  // Dark (Sakit)
                ],
                borderRadius: 4,
                barThickness: 25
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { drawBorder: false },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endsection