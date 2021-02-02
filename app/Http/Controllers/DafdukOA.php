<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

use App\Http\Controllers\Controller;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class DafdukOA extends Controller
{
    public function kk()
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
                                'nama' => 'Statistik Jumlah Kepala Keluarga Menurut jenis Kelamin'
                            ],
                            [
                                'id' => 2, 
                                'nama' => 'Statistik Jumlah Kepala Keluarga Menurut Pendidikan Terakhir'
                            ],
                            [
                                'id' => 3, 
                                'nama' => 'Statistik Jumlah Kepala Keluarga Menurut Status Perkawinan'
                            ],
                            [
                                'id' => 4, 
                                'nama' => 'Statistik Jumlah Kepala Keluarga Menurut Golongan Darah'
                            ],
                            [
                                'id' => 5, 
                                'nama' => 'Statistik Jumlah Kepala Keluarga Menurut Agama'
                            ],
                        ],
        );
        return view('konten/dafduk_oa/kk', $data);
    }

    public function biodata()
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
                                'nama' => 'Statistik Jumlah Penduduk Menurut jenis Kelamin'
                            ],
                            [
                                'id' => 2, 
                                'nama' => 'Statistik Jumlah Penduduk Menurut Pendidikan Akhir'
                            ],
                            [
                                'id' => 3, 
                                'nama' => 'Statistik Jumlah Penduduk Menurut Status Perkawinan'
                            ],
                            [
                                'id' => 4, 
                                'nama' => 'Statistik Jumlah Penduduk Menurut Golongan Darah'
                            ],
                            [
                                'id' => 5, 
                                'nama' => 'Statistik Jumlah Penduduk Menurut Agama'
                            ],
                            [
                                'id' => 6, 
                                'nama' => 'Statistik Jumlah Penduduk Menurut Status Hubungan Dalam Keluarga'
                            ],
                        ],
        );
        return view('konten/dafduk_oa/biodata', $data);
    }

    public function pindah()
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
                                'nama' => 'Jumlah Surat Pindah Menurut Alasan Kepindahan'
                            ],
                            [
                                'id' => 2, 
                                'nama' => 'Jumlah Surat Pindah Menurut Klasifikasi Kepindahan'
                            ],
                            [
                                'id' => 3, 
                                'nama' => 'Jumlah Anggota Pindah Menurut Alasan Kepindahan'
                            ],
                            [
                                'id' => 4, 
                                'nama' => 'Jumlah Anggota Pindah Menurut Klasifikasi Kepindahan'
                            ],
                            [
                                'id' => 5, 
                                'nama' => 'Jumlah Anggota Pindah Menurut Jenis Kelamin'
                            ],
                        ],
        );
        return view('konten/dafduk_oa/pindah', $data);
    }

    public function datang()
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
                                'nama' => 'Jumlah Kedatangan Menurut Alasan Kepindahan'
                            ],
                            [
                                'id' => 2, 
                                'nama' => 'Jumlah Kedatangan Menurut Klasifikasi Kepindahan'
                            ],
                            [
                                'id' => 3, 
                                'nama' => 'Jumlah Kedatangan Menurut Jenis Kedatangan'
                            ],
                            [
                                'id' => 4, 
                                'nama' => 'Jumlah Anggota Datang Menurut Alasan Kepindahan'
                            ],
                            [
                                'id' => 5, 
                                'nama' => 'Jumlah Anggota Datang Menurut Klasifikasi Kepindahan'
                            ],
                            [
                                'id' => 6, 
                                'nama' => 'Jumlah Anggota Datang Menurut Jenis Kedatangan'
                            ],
                            [
                                'id' => 7, 
                                'nama' => 'Jumlah Anggota Datang Menurut Jenis Kelamin'
                            ],
                        ],
        );
        return view('konten/dafduk_oa/datang', $data);
    }

}
