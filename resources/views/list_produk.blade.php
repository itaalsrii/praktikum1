<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Produk</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div> <h1>Input Produk</h1></div>
<form method="POST" action="{{ route('produk.simpan') }}">
    @csrf <table class="table">
        <tr>
            <td>Nama:</td>
            <td colspan="3"><input type="text" class="form-control" id="nama" name="nama"></td>
        </tr>
        <tr>
            <td>Deskripsi:</td>
            <td colspan="3"><textarea class="form-control" id="deskripsi" name="deskripsi"></textarea></td>
        </tr>
        <tr>
            <td>Harga:</td>
            <td><input type="number" class="form-control" id="harga" name="harga"></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</body>
</html>