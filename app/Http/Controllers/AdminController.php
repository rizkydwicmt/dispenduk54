<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller; 

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = array(
            'total' => 0,
            'dikonfirmasi' => 0,
            'menunggu' => 0,
            'ditolak' => 0,
            'bulan' => 0,
            'bulan_ini' => 0,
            'persen' => 0,
            'color_bulan' => 0,
            'pendaftar' => [],
            'harga' => (int) env('HARGA_HIGHGAMER',0),
            'salt' => env('SALT')
        );

        return view('konten/dashboard', $data);
    }
}
