<?php

namespace App\Http\Controllers;

use App\Models\blog_model;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {

        $data['datablog'] = blog_model::all();
        return view('blog',$data);
    }

    public function addBlog(Request $request)
    {

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
 
            // Mengambil data yang dikirimkan melalui formulir
            $judul = $request->input('judul');
            $deskripsi = $request->input('deskripsi');
            $foto = $request->file('foto'); // Jika menggunakan input type file, perlu menggunakan file() untuk mengambil file yang diunggah
    
            $path = $foto->store('public/images/blog');
            $gambar = basename($path);
            // Lakukan operasi lain yang diperlukan, seperti menyimpan data ke database atau melakukan manipulasi pada gambar
    
            // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        
        blog_model::create([
            'judul'=> $judul,
            'deskripsi'=> $deskripsi,
            'foto'=> $gambar,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Blog berhasil ditambahkan');

    }

    public function updateBlog(Request $request, $id)
    {
        $foto = $request->file('foto'); // Jika menggunakan input type file, perlu menggunakan file() untuk mengambil file yang diunggah

        $path = $foto->store('public/images/blog');
        $gambar = basename($path);
        
        $blog = blog_model::find($id);

        $blog->judul            = $request->judul;
        $blog->deskripsi        = $request->deskripsi;
        $blog->foto             = $gambar;
        $blog->updated_at       = date('Y-m-d H:i:s');
        $blog->save();

        return redirect()->back()->with('success', 'Blog berhasil diupdate');
    }

    public function deleteBlog(Request $request, $id)
    {

        $blog = blog_model::find($id);
        $blog->delete();

        return redirect()->back()->with('success', 'Blog berhasil dihapus');
    }


}
