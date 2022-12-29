<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Agama;
use App\Models\Pekerjaan;
use App\Models\Desa;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.penduduk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.penduduk.form',[
            'agama'=>Agama::get(),
            'pekerjaan'=>Pekerjaan::get(),
            'desa'=>Desa::get(),
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
            'nik'=>'required|unique:penduduks,nik',
            'tempat_lahir'=>'required',
            'jk' =>'required',
            'agama'=>'required',
            'status_kawin'=>'required',
            'pekerjaan'=>'required',
            'kewarganegaraan'=>'required',
            'goldar'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'tgl_lahir'=>'required',
            'nama_ibu'=>'required',
            'nama_ayah'=>'required',
            'pendidikan_terakhir'=>'required',
            'desa'=>'required'
        ]);

        Penduduk::create([
            'nik'=>$request->nik,
            'tempat_lahir'=>$request->tempat_lahir,
            'jk' =>$request->jk,
            'id_agama'=>$request->agama,
            'status_kawin'=>$request->status_kawin,
            'id_pekerjaan'=>$request->pekerjaan,
            'kewarganegaraan'=>$request->kewarganegaraan,
            'goldar'=>$request->goldar,
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'tgl_lahir'=>date('Y-m-d',strtotime($request->tgl_lahir)),
            'nama_ibu'=>$request->nama_ibu,
            'nama_ayah'=>$request->nama_ayah,
            'pendidikan_terakhir'=>$request->pendidikan_terakhir,
            'id_desa'=>$request->desa,
            'penghasilan'=>$request->penghasilan
        ]);

        User::create([
            'nama'=>$request->nama,
            'username'=>$request->nik,
            'password'=>Hash::make(date('Ymd',strtotime($request->tgl_lahir))),
            'jabatan'=>'penduduk',
        ]);


        return redirect()->route('penduduk.index')->with(['message'=>'Tambah data penduduk berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function edit(Penduduk $penduduk)
    {
        if($penduduk){
            return view('pages.penduduk.form',[
                'agama'=>Agama::get(),
                'pekerjaan'=>Pekerjaan::get(),
                'desa'=>Desa::get(),
                'penduduk'=>$penduduk,
                'id'=>$penduduk->id
            ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        $request->validate([
            'nik'=>'required|unique:penduduks,nik,'.$penduduk->id,
            'tempat_lahir'=>'required',
            'jk' =>'required',
            'agama'=>'required',
            'status_kawin'=>'required',
            'pekerjaan'=>'required',
            'kewarganegaraan'=>'required',
            'goldar'=>'required',
            'nama'=>'required',
            'alamat'=>'required',
            'tgl_lahir'=>'required',
            'nama_ibu'=>'required',
            'nama_ayah'=>'required',
            'pendidikan_terakhir'=>'required',
            'desa'=>'required'
        ]);

        $penduduk->update([
            'nik'=>$request->nik,
            'tempat_lahir'=>$request->tempat_lahir,
            'jk' =>$request->jk,
            'id_agama'=>$request->agama,
            'status_kawin'=>$request->status_kawin,
            'id_pekerjaan'=>$request->pekerjaan,
            'kewarganegaraan'=>$request->kewarganegaraan,
            'goldar'=>$request->goldar,
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'tgl_lahir'=>date('Y-m-d',strtotime($request->tgl_lahir)),
            'nama_ibu'=>$request->nama_ibu,
            'nama_ayah'=>$request->nama_ayah,
            'pendidikan_terakhir'=>$request->pendidikan_terakhir,
            'id_desa'=>$request->desa,
        ]);

        return redirect()->route('penduduk.index')->with(['message'=>'Update data penduduk berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penduduk  $penduduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penduduk $penduduk)
    {
        if($penduduk){
            $penduduk->delete();
            return redirect()->route('penduduk.index')->with(['message'=>'Hapus data penduduk berhasil']);
        }

        return abort(404);
    }
}
