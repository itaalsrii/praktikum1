<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // Dipastikan model Produk sudah di-import [cite: 78, 89]

class ListProdukController extends Controller
{
    // Fungsi dari Minggu ke-8 untuk menampilkan data ke halaman view 
    public function show()
    {
        $produk = Produk::all();

        return view('list_produk', compact('produk'));
    }

    public function simpan(Request $request)
    {
        $produk = new Produk; 
        $produk->nama = $request->input('nama'); 
        $produk->deskripsi = $request->input('deskripsi'); 
        $produk->harga = $request->input('harga'); 
        $produk->save(); 

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
    public function delete($id) {
    $produk = Produk::where('id', $id)->first();

    if ($produk) {
        $produk->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }
}
public function edit($id) {
    $produk = Produk::find($id);
    return view('edit_produk', compact('produk'));
}

public function update(Request $request, $id) {
    $produk = Produk::find($id);

    if ($produk) {
        $produk->nama = $request->nama;
        $produk->desc = $request->desc;
        $produk->harga = $request->harga;
        $produk->save();

        return redirect('/listproduk')->with('success', 'Produk berhasil diupdate.');
    } else {
        return redirect('/listproduk')->with('error', 'Produk tidak ditemukan.');
    }
}
}