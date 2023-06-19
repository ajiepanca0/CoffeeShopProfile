<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        return view('blog');
    }

    public function store(Request $request)
    {
        Barang::create([
            'id_kategory'=> $request->id_kategory,
            'nama_barang'=> $request->nama_barang,
            'harga'=> $request->harga,
            'stok'=> $request->stok,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),

        ]);
        return redirect('/barang')->with('success','Data Berhasil Disimpan');
    }
}
