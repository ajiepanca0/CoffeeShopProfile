<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CoffeeController extends Controller
{
    
    public function index()
    {
        return view('coffee');
    }

    public function sendPromo(Request $request)
    {

        // dd($request->phone);

        $apiUrl = 'https://wa.ajie.me/api/v1/messages';
    $token = 'dk_9a1eb0e9c3274ee9a58967eb8c703c95';
    $recipientType = $request->input('recipient_type');
    $to = $request->phone;
    $type = 'text';
    $body = "testing";

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

        return redirect()->back()->with('success', 'berhasil mendapatkan');

    } else {
        return redirect()->back()->with('failed', 'gagal Mendapatkan');
    }

    }

}
