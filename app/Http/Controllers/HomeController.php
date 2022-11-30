<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\DetailBantuan;
use App\Models\Bantuan;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_penduduk = Penduduk::count();
        $total_desa = Desa::count();
        $total_kecamatan = Kecamatan::count();
        $total_bantuan = DetailBantuan::count();
        return view('home',[
            'total_desa' => $total_desa,
            'total_kecamatan' => $total_kecamatan,
            'total_bantuan' => $total_bantuan,
            'total_penduduk'=>$total_penduduk
        ]);
    }

    public function cart(Request $request)
    {
        $year = date('Y');
        $month = $this->monthCustom();
        $data = [];
        if($request->data == 'cart1'){
            foreach($month as $row){
                $query = DetailBantuan::query();
                $query = $query->with('bantuan.jenis');
                $query = $query->whereHas('bantuan',function($qr)use($year,$row){
                    $qr->whereBetween('tgl_pengajuan', [Carbon::parse($year."-".$row['key']."-".'01'),Carbon::parse($year."-".$row['key']."-".'30')]);
                })->get();
                array_push($data,[
                    'month'=>$row['display'],
                    'count'=> $query->count(),
                ]);
            }
            return $data;
        }

        if($request->data == 'cart2')
        {
            return 'cart2';
        }
    }


    public function monthCustom()
    {
        return [
            [
                "display"=>"Januari",
                "key"=>"01"
            ],
            [
                "display"=>"Februari",
                "key"=>"02"
            ],
            [
                "display"=>"Maret",
                "key"=>"03"
            ],
            [
                "display"=>"April",
                "key"=>"04"
            ],
            [
                "display"=>"Mei",
                "key"=>"05"
            ],
            [
                "display"=>"Juni",
                "key"=>"06"
            ],
            [
                "display"=>"Juli",
                "key"=>"07"
            ],
            [
                "display"=>"Agustus",
                "key"=>"08"
            ],
            [
                "display"=>"September",
                "key"=>"09"
            ],
            [
                "display"=>"Oktober",
                "key"=>"10"
            ],
            [
                "display"=>"November",
                "key"=>"11"
            ],
            [
                "display"=>"Desember",
                "key"=>"12"
            ],
        ];
    }
}
