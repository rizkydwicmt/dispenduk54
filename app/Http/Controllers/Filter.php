<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

use App\Http\Controllers\Controller;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class Filter extends Controller
{
    public function kecamatan(Request $request)
    {
        
        $kecamatan = Kecamatan::where('NO_KAB', $request->id)->select('NO_KEC', 'NAMA_KEC')->get();
    
        return $kecamatan;
    }

    public function kelurahan(Request $request)
    {
        $kelurahan = Kelurahan::select('NO_KEL', 'NAMA_KEL');
        if($request->id !== 'semua') $kelurahan->where('NO_KEC', $request->id);

        $kelurahan = $kelurahan->get();

        return $kelurahan;
    }
}
