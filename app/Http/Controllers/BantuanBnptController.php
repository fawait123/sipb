<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BantuanBnptController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.bantuan.bnpt.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.bantuan.bnpt.form',[
            'penduduk' =>Penduduk::with('agama')->get()
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
        $jenis = JenisBantuan::where('nama_bantuan','like','%bnpt%')->first();

        $bantuan = Bantuan::create([
            'id_jenis_bantuan'=>$jenis ? $jenis->id : 1,
            'status'=>'Diajukan',
            'tgl_pengajuan'=>$request->tgl_pengajuan,
            'no_surat'=>$request->no_surat,
            'id_user_input'=>auth()->user()->id,
            'status'=>null,
        ]);

        foreach(json_decode($request->data) as $item){
            DetailBantuan::create([
                'id_penduduk'=>$item->id,
                'id_bantuan'=>$bantuan->id,
                'status_pengajuan'=>'Sedang diajukan',
                'id_user_verifikator'=>null
            ]);
        }

        return redirect()->route('bnpt.index')->with(['message'=>'Pengajuan bnpt berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bantuans = Bantuan::with(['detail.penduduk','detail.verifikator'])->where('id',$id)->first();
        $data = [];
        foreach($bantuans->detail as $bantuan){
            array_push($data,[
                'id'=>$bantuan->penduduk->id,
                'nik'=>$bantuan->penduduk->nik,
                'nama'=>$bantuan->penduduk->nama,
                'tempat_lahir'=>$bantuan->penduduk->tempat_lahir,
                'tgl_lahir'=>$bantuan->penduduk->tgl_lahir,
                'jk'=>$bantuan->penduduk->jk,
                'agama'=>$bantuan->penduduk->agama->agama,
                'status_kawin'=>$bantuan->penduduk->status_kawin,
                'kewarganegaraan'=>$bantuan->penduduk->kewarganegaraan,
                'status'=>$bantuan->status_pengajuan,
                'verifikator'=>$bantuan->verifikator->nama
            ]);
        }

        if($bantuans){
            return view('pages.bantuan.bnpt.show',[
                'penduduk' =>Penduduk::with('agama')->get(),
                'bnpt'=>$bantuans,
                'data'=>$data,
                'id'=>$bantuan->id
            ]);
        }

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bantuans = Bantuan::with('detail.penduduk')->where('id',$id)->first();
        $data = [];
        foreach($bantuans->detail as $bantuan){
            array_push($data,[
                'id'=>$bantuan->penduduk->id,
                'nik'=>$bantuan->penduduk->nik,
                'nama'=>$bantuan->penduduk->nama,
                'tempat_lahir'=>$bantuan->penduduk->tempat_lahir,
                'tgl_lahir'=>$bantuan->penduduk->tgl_lahir,
                'jk'=>$bantuan->penduduk->jk,
                'agama'=>$bantuan->penduduk->agama->agama,
                'status_kawin'=>$bantuan->penduduk->status_kawin,
                'kewarganegaraan'=>$bantuan->penduduk->kewarganegaraan,
            ]);
        }
        // dd($data);
        if($bantuans){
            return view('pages.bantuan.bnpt.form',[
                'penduduk' =>Penduduk::with('agama')->get(),
                'bnpt'=>$bantuans,
                'data'=>$data,
                'id'=>$bantuan->id
            ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Bantuan::where('id',$id)->update([
            'tgl_pengajuan'=>$request->tgl_pengajuan,
            'id_user_input'=>auth()->user()->id,
        ]);
        DetailBantuan::where('id_bantuan',$id)->delete();
        foreach(json_decode($request->data) as $item){
            DetailBantuan::create([
                'id_penduduk'=>$item->id,
                'id_bantuan'=>$id,
                'status_pengajuan'=>'Sedang diajukan',
                'id_user_verifikator'=>null
            ]);
        }

        return redirect()->route('bnpt.index')->with(['message'=>'Update bnpt berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bantuan::where('id',$id)->delete();
        DetailBantuan::where('id_bantuan',$id)->delete();

        return redirect()->route('bnpt.index')->with(['message'=>'Hapus bnpt berhasil']);
    }

    public function formVerify($id)
    {
        $bantuans = Bantuan::with('detail.penduduk')->where('id',$id)->first();
        $data = [];
        foreach($bantuans->detail as $bantuan){
            array_push($data,[
                'id'=>$bantuan->penduduk->id,
                'nik'=>$bantuan->penduduk->nik,
                'nama'=>$bantuan->penduduk->nama,
                'tempat_lahir'=>$bantuan->penduduk->tempat_lahir,
                'tgl_lahir'=>$bantuan->penduduk->tgl_lahir,
                'jk'=>$bantuan->penduduk->jk,
                'agama'=>$bantuan->penduduk->agama->agama,
                'status_kawin'=>$bantuan->penduduk->status_kawin,
                'kewarganegaraan'=>$bantuan->penduduk->kewarganegaraan,
                'check'=>false
            ]);
        }
        // dd($data);
        if($bantuans){
            return view('pages.bantuan.bnpt.verify',[
                'penduduk' =>Penduduk::with('agama')->get(),
                'bnpt'=>$bantuans,
                'data'=>$data,
                'id'=>$bantuan->id
    ]);
        }

        return abort(404);
    }

    public function verifyBantuan(Request $request,$id)
    {
        Bantuan::where('id',$id)->update([
            'status' => 'Diverifikasi',
        ]);

        foreach(json_decode($request->data) as $bantuan){
            $verif = $bantuan->check == true ? 'Diterima' : 'Ditolak';
            DetailBantuan::where('id_penduduk',$bantuan->id)->update([
                'status_pengajuan'=> $verif,
                'id_user_verifikator'=>auth()->user()->id
            ]);
        }

        return redirect()->route('bnpt.index')->with(['message'=>'Verifikasi bantuan bnpt berhasil']);
    }

    public function bagikanBantuan($id)
    {
        $bantuans = Bantuan::with('detail.penduduk')->where('id',$id)->first();
        $data = [];
        foreach($bantuans->detail as $bantuan){
            array_push($data,[
                'id'=>$bantuan->penduduk->id,
                'nik'=>$bantuan->penduduk->nik,
                'nama'=>$bantuan->penduduk->nama,
                'tempat_lahir'=>$bantuan->penduduk->tempat_lahir,
                'tgl_lahir'=>$bantuan->penduduk->tgl_lahir,
                'jk'=>$bantuan->penduduk->jk,
                'agama'=>$bantuan->penduduk->agama->agama,
                'status_kawin'=>$bantuan->penduduk->status_kawin,
                'kewarganegaraan'=>$bantuan->penduduk->kewarganegaraan,
                'status'=>$bantuan->status_pengajuan,
                'check'=>$bantuan->status_pengajuan == 'Sudah Dibagikan' ? true : false
            ]);
        }
        // dd($data);
        if($bantuans){
            return view('pages.bantuan.bnpt.donate',[
                'penduduk' =>Penduduk::with('agama')->get(),
                'bnpt'=>$bantuans,
                'data'=>$data,
                'id'=>$bantuan->id
            ]);
        }

        return abort(404);
    }


    public function bagikanBantuanAction(Request $request)
    {
        if($request->filled("data")){
            DetailBantuan::whereIn('id_penduduk',$request->data)->update([
                'status_pengajuan'=> 'Sudah Dibagikan'
            ]);

            return 'success';
        }

        if($request->filled("id_penduduk")){
            DetailBantuan::where('id_penduduk',$request->id_penduduk)->update([
                'status_pengajuan'=> 'Sudah Dibagikan'
            ]);
            return 'success';
        }

        return 'success';
    }
}