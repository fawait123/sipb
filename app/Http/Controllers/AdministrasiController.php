<?php

namespace App\Http\Controllers;

use App\Models\Administrasi;
use Illuminate\Http\Request;

class AdministrasiController extends Controller
{
    public function pkh(Request $request)
    {
        return view('pages.administrasi.pkh');
    }

    public function konfirmasi(Request $request)
    {
        if($request->jenis=='PKH'){
            Administrasi::where('jenis_bantuan','PKH')->where('id_desa',auth()->user()->id_desa)->where('status','Lolos')->where('konfirmasi',0)->update([
                'konfirmasi'=>true,
                'tracking'=>'Dikonfirmasi Admin Desa'
            ]);
            $url = '/administrasi/pkh?jenis=PKH';
            return redirect($url)->with(['message'=>'Konfirmasi berhasil']);
        }else{
            Administrasi::where('jenis_bantuan','BPNT')->where('id_desa',auth()->user()->id_desa)->where('status','Lolos')->where('konfirmasi',0)->update([
                'konfirmasi'=>true,
                'tracking'=>'Dikonfirmasi Admin Desa'
            ]);
            $url = '/administrasi/pkh?jenis=BPNT';
            return redirect($url)->with(['message'=>'Konfirmasi berhasil']);
        }
    }
}
