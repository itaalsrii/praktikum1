<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ListProdukController extends Controller
{
    public function show()
{
    $produk = Produk::all();

    return view('list_produk', compact('produk'));
}
}
