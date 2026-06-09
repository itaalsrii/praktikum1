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
}