<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Produk</title>
    @vite('resources/css/app.css')
</head>
<body class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-teal-600">Input Produk</h1>
    </div>

    <!-- Form Input Produk -->
    <form method="POST" action="{{ route('produk.simpan') }}" class="mb-6">
        @csrf
        <table class="table-auto w-full border-collapse border border-gray-300">
            <tr>
                <td class="border px-4 py-2">Nama:</td>
                <td colspan="3"><input type="text" class="form-control w-full border px-2 py-1" id="nama" name="nama"></td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Deskripsi:</td>
                <td colspan="3"><textarea class="form-control w-full border px-2 py-1" id="deskripsi" name="deskripsi"></textarea></td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Harga:</td>
                <td><input type="number" class="form-control border px-2 py-1" id="harga" name="harga"></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <button type="submit" class="bg-teal-500 text-white px-4 py-2 mt-2 rounded">Simpan</button>
    </form>

    <!-- Tabel List Produk -->
    <h2 class="text-xl font-semibold text-teal-700 mb-4">Daftar Produk</h2>
    <table class="min-w-full border-collapse border border-gray-300">
        <thead class="bg-teal-500 text-white">
            <tr>
                <th class="border px-4 py-2">No</th>
                <th class="border px-4 py-2">Nama Produk</th>
                <th class="border px-4 py-2">Deskripsi</th>
                <th class="border px-4 py-2">Harga</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $index => $item)
            <tr>
                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                <td class="border px-4 py-2">{{ $item->nama }}</td>
                <td class="border px-4 py-2">{{ $item->deskripsi }}</td>
                <td class="border px-4 py-2">{{ $item->harga }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <!-- Tombol Edit -->
                    <a href="{{ route('produk.edit', $item->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>
                    
                    <!-- Tombol Delete -->
                    <form action="{{ route('produk.delete', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus {{ $item->nama }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
