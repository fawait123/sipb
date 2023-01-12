<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use App\Models\JenisBantuan;
use App\Models\Administrasi;
use App\Models\Desa;

class PendaftaranController extends Controller
{
    public function pendaftaranbnpt()
    {
        $penduduk = Penduduk::where('nik',auth()->user()->username)->first();
        $pendaftaran = Administrasi::with('penduduk')->where('id_penduduk',$penduduk->id)->latest()->first();
        $umur = $this->getRange($penduduk->tgl_lahir,date('Y-m-d'));
        $jenis = JenisBantuan::all();
        $desa = Desa::all();
        return view('pages.pendaftaran.bnpt.index',compact('pendaftaran','penduduk','umur','jenis','desa'));
    }

    public function getRange($start,$end){
        return CarbonPeriod::create($start,$end);
    }

    public function store(Request $request)
    {
        $penduduk = Penduduk::where('nik',auth()->user()->username)->first();
        Administrasi::create([
            'id_desa'=>$penduduk->id_desa,
            'nik'=>$penduduk->nik,
            'nama'=>$penduduk->nama,
            'nama'=>$penduduk->nama,
            'id_penduduk'=>$penduduk->id,
            'jk'=>$penduduk->jk,
            'alamat'=>$penduduk->alamat,
            'status_kawin'=>$penduduk->status_kawin,
            'foto_ktp'=>$request->ktp,
            'foto_penghasilan'=>$request->penghasilan,
            'jenis_bantuan'=>$request->jenis_bantuan,
            'status'=>'Terdaftar'
        ]);
        // $request->validate([
        //     'id_desa'=>'required',
        //     'id_jenis_bantuan'=>'required',
        // ]);

        // Pendaftaran::create(array_merge($request->all(),['tgl_pendaftaran'=>date('Y-m-d'),'status'=>'terdaftar']));
        return redirect()->route('bnpt.pendaftaran')->with(['message'=>'Pendaftaran bantuan berhasil']);
    }

    public function index()
    {
        return view('pages.pendaftaran.index');
    }
}
