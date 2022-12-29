<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use App\Models\JenisBantuan;
use App\Models\Desa;

class PendaftaranController extends Controller
{
    public function pendaftaranbnpt()
    {
        $penduduk = Penduduk::where('nik',auth()->user()->username)->first();
        $pendaftaran = Pendaftaran::with('penduduk')->where('id_penduduk',$penduduk->id)->latest()->first();
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
        $request->validate([
            'id_desa'=>'required',
            'id_jenis_bantuan'=>'required',
        ]);

        Pendaftaran::create(array_merge($request->all(),['tgl_pendaftaran'=>date('Y-m-d'),'status'=>'terdaftar']));
        return redirect()->route('bnpt.pendaftaran')->with(['message'=>'Pendaftaran bantuan berhasil']);
    }

    public function index()
    {
        return view('pages.pendaftaran.index');
    }
}
