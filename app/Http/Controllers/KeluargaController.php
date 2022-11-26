<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\Agama;
use App\Models\Desa;
use App\Models\Pekerjaan;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class KeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.keluarga.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.keluarga.form',[
            'agama'=>Agama::get(),
            'desa' =>Desa::get(),
            'pekerjaan'=>Pekerjaan::get(),
            'penduduk'=>Penduduk::get(),
            'keluarga'=>Keluarga::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_kk'=>'required|numeric',
            'kepala_keluarga'=>'required',
            'nik'=>'required|numeric',
            // 'tempat_lahir'=>'required',
            // 'jk' =>'required',
            // 'agama'=>'required',
            // 'status_kawin'=>'required',
            // 'pekerjaan'=>'required',
            // 'kewarganegaraan'=>'required',
            // 'goldar'=>'required',
            // 'nama'=>'required',
            // 'alamat'=>'required',
            // 'tgl_lahir'=>'required',
            // 'nama_ibu'=>'required',
            // 'nama_ayah'=>'required',
            // 'pendidikan_terakhir'=>'required',
            // 'desa'=>'required'
        ]);

        // check keluarga
        $checkKK = Keluarga::where('no_kk',$request->no_kk)->first();
        $dataKeluarga = null;
        if(!$checkKK){
           $dataKeluarga =  Keluarga::create([
                'no_kk'=>$request->no_kk,
                'kepala_keluarga'=>$request->kepala_keluarga,
            ]);
        }else{
            $dataKeluarga = Keluarga::where('no_kk',$request->no_kk)->update([
                'no_kk'=>$request->no_kk,
                'kepala_keluarga'=>$request->kepala_keluarga,
            ]);
        }

        $checkNIK = Penduduk::where('nik',$request->nik)->first();
        if($checkNIK){
            Penduduk::where('nik',$request->nik)->update([
                // 'nik'=>$request->nik,
                // 'tempat_lahir'=>$request->tempat_lahir,
                // 'jk' =>$request->jk,
                // 'id_agama'=>$request->agama,
                // 'status_kawin'=>$request->status_kawin,
                // 'id_pekerjaan'=>$request->pekerjaan,
                // 'kewarganegaraan'=>$request->kewarganegaraan,
                // 'goldar'=>$request->goldar,
                // 'nama'=>$request->nama,
                // 'alamat'=>$request->alamat,
                // 'tgl_lahir'=>date('Y-m-d',strtotime($request->tgl_lahir)),
                // 'nama_ibu'=>$request->nama_ibu,
                // 'nama_ayah'=>$request->nama_ayah,
                // 'pendidikan_terakhir'=>$request->pendidikan_terakhir,
                // 'id_desa'=>$request->desa,
                'id_keluarga'=> $checkKK ? $checkKK->id : $dataKeluarga->id,
            ]);
        }

        return redirect()->route('keluarga.index')->with(['message'=>'Tambah data keluarga '.$request->kepala_keluarga.' berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function show(Keluarga $keluarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluarga $keluarga)
    {
        if($keluarga){
            return view('pages.keluarga.form',[
                'agama'=>Agama::get(),
                'desa' =>Desa::get(),
                'pekerjaan'=>Pekerjaan::get(),
                'penduduk'=>Penduduk::get(),
                'keluarga'=>$keluarga,
                'id'=>$keluarga->id,
            ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keluarga $keluarga)
    {
        $keluarga->update([
            'no_kk'=>$request->no_kk,
            'kepala_keluarga'=>$request->kepala_keluarga,
        ]);

        return redirect()->route('keluarga.index')->with(['message'=>'Update data keluarga berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluarga  $keluarga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keluarga $keluarga)
    {
        if($keluarga){
            $keluarga->delete();
            return redirect()->route('keluarga.index')->with(['message' =>'Hapus data keluarga berhasil']);
        }

        return abort(404);
    }

    public function findKeluarga(Request $request)
    {
        return Keluarga::where('no_kk',$request->no_kk)->first();
    }

    public function findPenduduk(Request $request)
    {
        return Penduduk::where('nik',$request->nik)->first();
    }
}
