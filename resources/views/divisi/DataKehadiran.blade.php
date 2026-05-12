@extends('layouts.admin')

@section('content')
<style>
    .header-panel {
        background: #d3d3d3;
        padding: 40px;
        border-radius: 12px;
        margin: 20px;
    }
    .header-panel h2 {
        font-weight: bold;
        color: #000;
        margin: 0;
    }
    .search-section {
        display: flex;
        gap: 15px;
        padding: 0 20px;
        margin-bottom: 20px;
    }
    .search-box {
        background: #d3d3d3;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        flex-grow: 1;
        display: flex;
        align-items: center;
    }
    .search-box input {
        background: transparent;
        border: none;
        outline: none;
        width: 100%;
        margin-left: 10px;
    }
    .btn-filter {
        background: #d3d3d3;
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .table-frame {
        border: 1px solid #999;
        border-radius: 15px;
        margin: 20px;
        overflow: hidden;
        background: #fff;
    }
    .table thead {
        background: #c0c0c0;
        border-bottom: 2px solid #999;
    }
    .table th {
        padding: 12px;
        text-align: center;
        border-right: 1px solid #999;
        font-weight: bold;
    }
    .action-btns {
        text-align: right;
        padding-right: 15px;
    }
    .action-btns i {
        cursor: pointer;
        margin-left: 10px;
        font-size: 1.1rem;
    }
</style>

<div class="header-panel">
    <h2>Data Kehadiran Karyawan<br>Divisi HRD</h2>
</div>

<form action="{{ route('divisi.kehadiran') }}" method="GET" class="d-flex gap-2 mb-3">
    <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" name="search" class="form-control rounded-pill" placeholder="Cari nik dan nama karyawan.." value="{{ request('search') }}">
    </div>
    
    <select name="jabatan" class="btn btn-light border rounded shadow-sm">
        <option value="">Jabatan</option>
        <option value="Staff">Staff</option>
        <option value="Manager">Manager</option>
    </select>
    
    <button type="submit" class="btn btn-secondary px-4">Cari</button>
</form>

<div class="table-frame">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>No</th><th>Nik</th><th>Nama Karyawan</th><th>Divisi</th>
                <th>Jabatan</th><th>Tanggal</th><th>Jam Masuk</th><th>Jam Keluar</th>
                <th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kehadirans as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->karyawan->nik }}</td>
                <td>{{ $item->karyawan->nama_karyawan }}</td>
                <td>{{ $item->karyawan->divisi }}</td>
                <td>{{ $item->karyawan->jabatan }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->jam_masuk }}</td>
                <td>{{ $item->jam_keluar ?? '--:--' }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    <i class="bi bi-eye"></i> 
                    <i class="bi bi-trash ms-2"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection