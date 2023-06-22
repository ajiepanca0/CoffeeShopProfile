<?php

namespace App\Http\Controllers;

use App\Models\blog_model;
use App\Models\ProductModel;
use App\Models\PromoModel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use PDO;
use Promo;

class CoffeeController extends Controller
{
    
    public function index()
    {
        $data['dataproduct'] = ProductModel::all();
        $data['datablog'] = blog_model::all();

        return view('coffee',$data);
    }

    public function sendPromo(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'phone' => 'required',
        ]);

    $kodepromo = PromoModel::orderBy('created_at')->first();
    $kode = "";
    if($kodepromo != null){
        $kode = $kodepromo->kode;
    }else{
        echo "Kode promo tidak ditemukan.";
    }

        
    $apiUrl = 'https://wa.ajie.me/api/v1/messages';
    $token = 'dk_9a1eb0e9c3274ee9a58967eb8c703c95';
    $recipientType = $request->input('recipient_type');
    $to = $request->phone;
    $type = 'text';
    $body = "UD DJAYA COFFE \n\nSelamat ".$request->name." Berhasil Mendapatkan Kode Promo. Tukarkan Kode Berikut Ketika Berkunjung\n\nKode Promo : ".$kode."\n\nTerimakasih Sampai Bertemu";

    $client = new Client();
    $response = $client->post($apiUrl, [
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ],
        'json' => [
            'recipient_type' => $recipientType,
            'to' => $to,
            'type' => $type,
            'text' => [
                'body' => $body,
            ],
        ],
    ]);

    $statusCode = $response->getStatusCode();
    $responseData = json_decode($response->getBody(), true);

    if ($statusCode === 200) {

        $promo = PromoModel::where('kode',$kode)->first();
        $promo->delete();

        return redirect()->back()->with('success', 'berhasil mendapatkan');

    } else {
        return redirect()->back()->with('failed', 'gagal Mendapatkan');
    }

    }

}
