@extends('layouts.admin')

@section('content')
<style>
    .tab-container { display: flex; gap: 10px; margin: 20px; }
    .btn-tab { background: #d3d3d3; border: none; padding: 8px 20px; border-radius: 8px; font-weight: bold; color: #333; cursor: pointer; }
    .btn-tab.active { background: #a0a0a0; color: #fff; }
    
    /* Sembunyikan konten riwayat secara default */
    #riwayat-content { display: none; }
    
    .header-panel { background: #d3d3d3; padding: 40px; border-radius: 12px; margin: 0 20px 20px 20px; }
    .header-panel h2 { font-weight: bold; margin: 0; }
    .table-frame { border: 1px solid #999; border-radius: 12px; margin: 0 20px; overflow: hidden; background: #fff; }
    .table thead { background: #c0c0c0; border-bottom: 2px solid #999; }
</style>

<div class="tab-container">
    <button class="btn-tab active" onclick="switchTab('verifikasi')">Verifikasi Data</button>
    <button class="btn-tab" onclick="switchTab('riwayat')">Riwayat Verifikasi Data</button>
</div>

<div id="verifikasi-content">
    <div class="header-panel">
        <h2>Verifikasi Data Perizinan Karyawan<br>Divisi HRD</h2>
    </div>

    <div class="table-frame">
        <table class="table mb-0 text-center w-100">
            <thead>
                <tr>
                    <th>No</th><th>Nik</th><th>Nama</th><th>divisi</th><th>jabatan</th><th>Jenis Izin</th><th>file pendukung</th><th>Verifikasi</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
    @foreach($izins as $index => $item) {{-- Pastikan di sini menggunakan $item --}}
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->karyawan->nik }}</td>
        <td>{{ $item->karyawan->nama_karyawan }}</td>
        <td>{{ $item->karyawan->divisi }}</td>
        <td>{{ $item->karyawan->jabatan }}</td>
        <td>{{ $item->tipe_izin }}</td>
        <td><a href="#" class="text-primary">Lihat File</a></td>
        <td>
            {{-- Tombol Verifikasi sesuai mockup --}}
            <button class="btn btn-link p-0 text-dark me-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
            </button>
            <button class="btn btn-link p-0 text-dark">
                <i class="bi bi-x-circle-fill fs-5"></i>
            </button>
        </td>
        <td><i class="bi bi-eye"></i></td>
    </tr>
    @endforeach
</tbody>
        </table>
    </div>
</div>

<div id="riwayat-content">
    <div class="header-panel">
        <h2>Riwayat Verifikasi Perizinan<br>Divisi HRD</h2>
    </div>

    <div class="table-frame">
        <table class="table mb-0 text-center w-100">
            <thead>
                <tr>
                    <th>No</th><th>Nik</th><th>Nama</th><th>divisi</th><th>jabatan</th><th>Jenis Izin</th><th>file pendukung</th><th>Verifikasi</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td><td>220101</td><td>Muflih Anwar</td><td>HRD</td><td>Staff</td><td>Sakit</td><td>png</td>
                    <td><span class="badge bg-success">Disetujui</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    function switchTab(type) {
        const verifContent = document.getElementById('verifikasi-content');
        const riwayatContent = document.getElementById('riwayat-content');
        const tabs = document.querySelectorAll('.btn-tab');

        // Reset Active Class
        tabs.forEach(tab => tab.classList.remove('active'));

        if (type === 'verifikasi') {
            verifContent.style.display = 'block';
            riwayatContent.style.display = 'none';
            tabs[0].classList.add('active');
        } else {
            verifContent.style.display = 'none';
            riwayatContent.style.display = 'block';
            tabs[1].classList.add('active');
        }
    }

    // Fungsi simulasi aksi tombol
    function approve(id) {
        alert("Data ID " + id + " Berhasil Disetujui!");
        // Di sini Anda bisa menambahkan fetch() ke Controller Laravel
    }

    function reject(id) {
        confirm("Yakin ingin menolak izin ini?");
    }
</script>
@endsection