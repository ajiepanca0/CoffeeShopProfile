<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $data['product'] = ProductModel::all();
        return view('product',$data);
    }

    public function addProduk(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
        ]);
 
            // Mengambil data yang dikirimkan melalui formulir
            $nama = $request->input('nama');
            $deskripsi = $request->input('deskripsi');
            $harga = $request->input('harga');
        
        ProductModel::create([
            'name'=> $nama,
            'description'=> $deskripsi,
            'price'=> $harga,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');

    }

    public function updateProduk(Request $request, $id)
    {
        
        $produk = ProductModel::find($id);

        $produk->name             = $request->nama;
        $produk->description     = $request->deskripsi;
        $produk->price            = $request->harga;
        $produk->updated_at       = date('Y-m-d H:i:s');
        $produk->save();

        return redirect()->back()->with('success', 'Produk berhasil diupdate');
    }

    
    public function deleteProduk(Request $request, $id)
    {

        $produk = ProductModel::find($id);
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }

}
