<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Produk</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="container mx-auto mt-10">

        <h1 class="text-3xl font-bold text-center text-blue-600 mb-8">
            Data Produk
        </h1>

        <div class="bg-white shadow-lg rounded-xl p-6">

            <table class="table-auto w-full border-collapse">

                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama Produk</th>
                        <th class="px-4 py-3">Deskripsi Produk</th>
                        <th class="px-4 py-3">Harga Produk</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($produk as $index => $item)

                    <tr class="text-center border-b hover:bg-gray-100">
                        <td class="px-4 py-3">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-4 py-3 font-semibold">
                            {{ $item->nama }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $item->deskripsi }}
                        </td>

                        <td class="px-4 py-3 text-green-600 font-bold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </td>
                    </tr>

                    @endforeach
                </tbody>

            </table>

        </div>

    </div>

</body>
</html>