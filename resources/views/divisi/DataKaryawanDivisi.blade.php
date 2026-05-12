@extends('layouts.admin')
@section('content')
<style>
    .header-panel { background: #d3d3d3; padding: 35px; border-radius: 8px; margin: 20px; }
    .header-panel h2 { font-weight: bold; margin: 0; }
    .filter-input { background: #d3d3d3; border: none; border-radius: 6px; padding: 10px; }
    .btn-filter { background: #d3d3d3; border: none; font-weight: 500; border-radius: 6px; padding: 10px 15px; }
    .table-frame { border: 1px solid #bbb; border-radius: 12px; margin: 20px; overflow: hidden; }
    .table thead { background: #c0c0c0; }
</style>

<div class="header-panel"><h2>Data Karyawan</h2></div>

<form action="{{ route('divisi.karyawan') }}" method="GET" class="d-flex gap-2 mb-3">
    <input type="text" name="search" class="form-control w-50" placeholder="Cari nik dan nama karyawan.." value="{{ request('search') }}">
    
    <select name="gender" class="form-select w-auto">
        <option value="">L / P</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select>
    
    <button type="submit" class="btn btn-secondary">Cari</button>
</form>

<div class="table-frame">
    <table class="table table-hover">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Nik</th>
            <th>Nama Karyawan</th>
            <th>Email</th> <th>Divisi</th>
            <th>Jabatan</th>
            <th>L/P</th>
            <th>Status</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($karyawans as $no => $k)
        <tr>
            <td>{{ $no + 1 }}</td>
            <td>{{ $k->nik }}</td>
            <td>{{ $k->nama_karyawan }}</td>
            <td>{{ $k->email }}</td>
            <td>{{ $k->divisi }}</td>
            <td>{{ $k->jabatan }}</td>
            <td>{{ $k->jenis_kelamin }}</td>
            <td>{{ $k->status }}</td>
            <td>{{ $k->role }}</td>
            <td>
                <i class="bi bi-eye"></i> 
                <i class="bi bi-pencil-square mx-1"></i> 
                <i class="bi bi-trash text-danger"></i>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection