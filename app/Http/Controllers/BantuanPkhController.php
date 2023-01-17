<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\JenisBantuan;
use App\Models\Bantuan;
use App\Models\DetailBantuan;
use App\Models\Pendaftaran;
use App\Models\Administrasi;

class BantuanPkhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.bantuan.pkh.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pendaftaran = Administrasi::with('penduduk')->where('status','Terdaftar')->where('jenis_bantuan','PKH')->get();
        return view('pages.bantuan.pkh.form',[
            'penduduk' =>Penduduk::with('agama')->get(),
            'pendaftaran'=>$pendaftaran
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
            'no_surat'=>'required',
            'tgl_pengajuan'=>'required',
        ]);

        $jenis = JenisBantuan::where('nama_bantuan','like','%pkh%')->first();

        $bantuan = Bantuan::create([
            'id_jenis_bantuan'=>$jenis ? $jenis->id : 1,
            'status'=>'Diajukan',
            'tgl_pengajuan'=>$request->tgl_pengajuan,
            'no_surat'=>$request->no_surat,
            'id_user_input'=>auth()->user()->id,
        ]);

        $pendaftaran = Administrasi::with('penduduk')->where('status','Terdaftar')->where('jenis_bantuan','PKH')->get();

        foreach($pendaftaran as $item){
            DetailBantuan::create([
                'id_penduduk'=>$item->id_penduduk,
                'id_bantuan'=>$bantuan->id,
                'status_pengajuan'=>'Sedang diajukan',
                'id_user_verifikator'=>null,
                'foto_ktp'=>$item->foto_ktp,
                'foto_penghasilan'=>$item->foto_penghasilan,
            ]);
            Administrasi::where('id',$item->id)->update([
                'status'=>'Sedang diajukan',
            ]);
        }

        return redirect()->route('pkh.index')->with(['message'=>'Pengajuan PKH berhasil ditambahkan']);
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
                'id'=>$bantuan->penduduk->id ?? '',
                'nik'=>$bantuan->penduduk->nik ?? '',
                'nama'=>$bantuan->penduduk->nama ?? '',
                'tempat_lahir'=>$bantuan->penduduk->tempat_lahir ?? '',
                'tgl_lahir'=>$bantuan->penduduk->tgl_lahir ?? '',
                'jk'=>$bantuan->penduduk->jk ?? '',
                'agama'=>$bantuan->penduduk->agama->agama ?? '',
                'status_kawin'=>$bantuan->penduduk->status_kawin ?? '',
                'kewarganegaraan'=>$bantuan->penduduk->kewarganegaraan ?? '',
                'status'=>$bantuan->status_pengajuan ?? '',
                'verifikator'=>$bantuan->verifikator->nama ?? '',
                'foto_ktp'=>$bantuan->foto_ktp ?? '',
                'foto_kk'=>$bantuan->foto_kk ?? '',
                'foto_penghasilan'=>$bantuan->foto_penghasilan ?? '',
            ]);
        }

        if($bantuans){
            return view('pages.bantuan.pkh.show',[
                'penduduk' =>Penduduk::with('agama')->get(),
                'pkh'=>$bantuans,
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
                'id'=>$bantuan->penduduk->id ?? '',
                'nik'=>$bantuan->penduduk->nik ?? '',
                'nama'=>$bantuan->penduduk->nama ?? '',
                'tempat_lahir'=>$bantuan->penduduk->tempat_lahir ?? '',
                'tgl_lahir'=>$bantuan->penduduk->tgl_lahir ?? '',
                'jk'=>$bantuan->penduduk->jk ?? '',
                'agama'=>$bantuan->penduduk->agama->agama ?? '',
                'status_kawin'=>$bantuan->penduduk->status_kawin ?? '',
                'foto_ktp'=>$bantuan->foto_ktp ?? '',
                'foto_penghasilan'=>$bantuan->foto_penghasilan ?? '',
            ]);
        }
        // dd($data);
        if($bantuans){
            return view('pages.bantuan.pkh.edit',[
                'penduduk' =>Penduduk::with('agama')->get(),
                'pkh'=>$bantuans,
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
            'no_surat'=>$request->no_surat
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

        return redirect()->route('pkh.index')->with(['message'=>'Update PKH berhasil']);
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

        return redirect()->route('pkh.index')->with(['message'=>'Hapus PKH berhasil']);
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
                'foto_ktp'=>$bantuan->foto_ktp,
                'foto_penghasilan'=>$bantuan->foto_penghasilan,
                'check'=>false
            ]);
        }
        // dd($data);
        if($bantuans){
            return view('pages.bantuan.pkh.verify',[
                'penduduk' =>Penduduk::with('agama')->get(),
                'pkh'=>$bantuans,
                'data'=>$data,
                'id'=>$bantuan->id
    ]);
        }

        return abort(404);
    }

    public function verifyBantuan(Request $request,$id)
    {
        $bantuan = Bantuan::where('id',$id)->first();
        Bantuan::where('id',$id)->update([
            'status' => 'Diverifikasi',
            'step'=> $bantuan->step + 1
        ]);

        foreach(json_decode($request->data) as $bantuan){
            $verif = $bantuan->check == true ? 'Diterima' : 'Ditolak';
            Administrasi::where('status','Diverifikasi')->where('id_penduduk',$bantuan->id)->update([
                'status'=> $verif
            ]);
            DetailBantuan::where('id_penduduk',$bantuan->id)->update([
                'status_pengajuan'=> $verif,
                'id_user_verifikator'=>auth()->user()->id
            ]);
        }

        return redirect()->route('pkh.index')->with(['message'=>'Verifikasi bantuan PKH berhasil']);
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
            return view('pages.bantuan.pkh.donate',[
                'penduduk' =>Penduduk::with('agama')->get(),
                'pkh'=>$bantuans,
                'data'=>$data,
                'id'=>$bantuans->id
            ]);
        }

        return abort(404);
    }


    public function bagikanBantuanAction(Request $request)
    {
        if($request->filled("data")){
            Bantuan::where('id',$request->id)->update([
                'tgl_penerimaan'=>date('Y-m-d')
            ]);
            DetailBantuan::whereIn('id_penduduk',$request->data)->update([
                'status_pengajuan'=> 'Sudah Disalurkan'
            ]);
            Administrasi::where('status','Dikirimkan Dari Kecamatan')->update([
                'status'=>'Sudah Disalurkan'
            ]);
            return 'success';
        }

        if($request->filled("id_penduduk")){
            Bantuan::where('id',$request->id)->update([
                'tgl_penerimaan'=>date('Y-m-d')
            ]);
            DetailBantuan::where('id_penduduk',$request->id_penduduk)->update([
                'status_pengajuan'=> 'Sudah Disalurkan'
            ]);
            Administrasi::where('status','Dikirimkan Dari Kecamatan')->where('id_penduduk',$request->id_penduduk)->update([
                'status'=>'Sudah Disalurkan'
            ]);
            return 'success';
        }

        return 'success';
    }

    public function konfirmasi($id)
    {
        $bantuan = Bantuan::where('id',$id)->first();
        if($bantuan){
            $status = '';
            if($bantuan->step == 2){
                $status = 'Dikirimkan Dari Kecamatan';
            }else if($bantuan->step == 1){
                $status = 'Diverifikasi Kabupaten';
            }else if($bantuan->step == 0){
                $status = 'Diverifikasi Kecamatan';
            }
            Bantuan::where('id',$id)->update([
                'status'=> $status,
                'step'=>$bantuan->step + 1
            ]);
            // $status = $bantuan->step == 2 ? 'Dikirimkan' : 'Diverifikasi Kecamatan';
            // if($bantuan->step == 2){
            //     Administrasi::where('status','Diterima')->update([
            //         'status'=>$status,
            //     ]);
            // }else{
            //     Administrasi::where('status','Sedang diajukan')->update([
            //         'status'=>$status,
            //     ]);
            // }

            Administrasi::where('status','Sedang diajukan')->orWhere('status','Diverifikasi Kecamatan')->orWhere('status','Diverifikasi Kabupaten')->update([
                'status'=>$status,
            ]);
            return redirect()->route('pkh.index')->with(['message'=>'Bantuan berhasil dikonfirmasi']);
        }
        return redirect()->route('pkh.index');
    }

    public function hapus($id)
    {
        Administrasi::where('id',$id)->delete();
        return redirect()->route('pkh.create')->with(['message'=>'pendaftaran berhasil dihapus']);
    }
}
