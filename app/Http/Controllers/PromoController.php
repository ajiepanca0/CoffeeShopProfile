<?php

namespace App\Http\Controllers;

use App\Models\PromoModel;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        $data['promo'] = PromoModel::all();
        return view('promo',$data);
    }

    public function addPromo(Request $request)
    {

        $request->validate([
            'kode' => 'required',
        ]);
 
            // Mengambil data yang dikirimkan melalui formulir
            $kode = $request->input('kode');
        
        PromoModel::create([
            'kode'=> $kode,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Promo berhasil ditambahkan');

    }

    public function updatePromo(Request $request, $id)
    {
        
        $promo = PromoModel::find($id);

        $promo->kode             = $request->kode;
        $promo->updated_at       = date('Y-m-d H:i:s');
        $promo->save();

        return redirect()->back()->with('success', 'Promo berhasil diupdate');
    }

    
    public function deletePromo(Request $request, $id)
    {

        $promo = PromoModel::find($id);
        $promo->delete();

        return redirect()->back()->with('success', 'Promo berhasil dihapus');
    }
}
