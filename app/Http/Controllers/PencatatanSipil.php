<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

use App\Http\Controllers\Controller;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class PencatatanSipil extends Controller
{
    public function kelahiranWNI()
    {
        $data = array(
            'provinsi' => [
                            [
                                'id' => 35, 
                                'nama' => 'Jawa Timur'
                            ],
                        ],
            'kabupaten' => Kabupaten::select('NO_KAB', 'NAMA_KAB')->get(),
            'statistik' => [
                            [
                                'id' => 1, 
                                'nama' => 'Statistik Menurut Jenis Kelamin'
                            ],
                            [
                                'id' => 2, 
                                'nama' => 'Statistik Menurut Penolong Kelahiran'
                            ],
                            [
                                'id' => 3, 
                                'nama' => 'Statistik Menurut Tempat Dilahirkan'
                            ],
                            [
                                'id' => 4, 
                                'nama' => 'Statistik Menurut Jenis Kelahiran'
                            ],
                        ],
        );
        return view('konten/pencatatan_sipil/kelahiran', $data);
    }

    public function kematian()
    {
        $data = array(
            'provinsi' => [
                            [
                                'id' => 35, 
                                'nama' => 'Jawa Timur'
                            ],
                        ],
            'kabupaten' => Kabupaten::select('NO_KAB', 'NAMA_KAB')->get(),
            'statistik' => [
                            [
                                'id' => 1, 
                                'nama' => 'Statistik Menurut Jenis Kelamin'
                            ],
                            [
                                'id' => 2, 
                                'nama' => 'Statistik Menurut Agama'
                            ],
                            [
                                'id' => 3, 
                                'nama' => 'Statistik Menurut Sebab Kematian'
                            ],
                            [
                                'id' => 5, 
                                'nama' => 'Statistik Menurut Yang Menerangkan'
                            ],
                        ],
        );
        return view('konten/pencatatan_sipil/kematian', $data);
    }

    public function perkawinan()
    {
        $data = array(
            'provinsi' => [
                            [
                                'id' => 35, 
                                'nama' => 'Jawa Timur'
                            ],
                        ],
            'kabupaten' => Kabupaten::select('NO_KAB', 'NAMA_KAB')->get(),
            'statistik' => [
                            [
                                'id' => 1, 
                                'nama' => 'Statistik Menurut Agama'
                            ],
                        ],
        );
        return view('konten/pencatatan_sipil/perkawinan', $data);
    }

    public function perceraian()
    {
        $data = array(
            'provinsi' => [
                            [
                                'id' => 35, 
                                'nama' => 'Jawa Timur'
                            ],
                        ],
            'kabupaten' => Kabupaten::select('NO_KAB', 'NAMA_KAB')->get(),
            'statistik' => [
                            [
                                'id' => 1, 
                                'nama' => 'Statistik Menurut Yang Mengajukan'
                            ],
                            [
                                'id' => 2, 
                                'nama' => 'Statistik Menurut Penyebab Perceraian'
                            ],
                        ],
        );
        return view('konten/pencatatan_sipil/perceraian', $data);
    }

    public function statistik_kelahiranWNI(Request $request){
        if($request->statistik == 1) $data = app('db')->table('t5_lhr_jenis_kelamin');
        // if($request->statistik == 2) $data = app('db')->table('t5_kepkel_pendidikan');
        if($request->statistik == 3) $data = app('db')->table('t5_lhr_tempat_dilahirkan');
        if($request->statistik == 4) $data = app('db')->table('t5_lhr_jenis_lahir');
        
        $data = $data
                ->whereYear('BLN', $request->tahun)
                ->where('NO_PROP', $request->provinsi)
                ->where('NO_KAB', $request->kabupaten)
                ->get();
                
        return $data;
    }
}
