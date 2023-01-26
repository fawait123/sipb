<?php

namespace App\Http\Controllers;

use App\Models\Bantuan;
use App\Models\Administrasi;
use App\Models\JenisBantuan;
use App\Models\DetailBantuan;
use Illuminate\Http\Request;

class BantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.bantuan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.bantuan.create');
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
            'file' => 'required|file|max:10000',
            'no_surat'=>'required',
            'tgl_pengajuan'=>'required'
        ]);
        $file = $request->file('file');
        $destinationPath = 'uploads';
        $file->move($destinationPath,$file->getClientOriginalName());
        $jenis = JenisBantuan::where('nama_bantuan','like',$request->jenis)->first();
        $bantuan = Bantuan::create([
            'id_jenis_bantuan'=>$jenis ? $jenis->id : 1,
            'status'=>'Dibuat dikecamatan',
            'tgl_pengajuan'=>$request->tgl_pengajuan,
            'no_surat'=>$request->no_surat,
            'id_user_input'=>auth()->user()->id,
            'file'=>$destinationPath.'/'. $file->getClientOriginalName()
        ]);

        $pendaftaran = Administrasi::with('penduduk')->where('status','Lolos')->where('konfirmasi',1)->where('jenis_bantuan',$request->jenis)->get();

        foreach($pendaftaran as $item){
            DetailBantuan::create([
                'id_penduduk'=>$item->id_penduduk,
                'id_bantuan'=>$bantuan->id,
                'status_pengajuan'=>'Dibuat dikecamatan',
                'id_user_verifikator'=>null,
                'foto_ktp'=>$item->foto_ktp,
                'foto_penghasilan'=>$item->foto_penghasilan,
            ]);
            Administrasi::where('id',$item->id)->update([
                'tracking'=>'Dibuat di Admin Kecamatan',
            ]);
        }
        $url = '/bantuan?jenis='.$request->jenis;
        return redirect($url)->with(['message'=>'Pengajuan '.$request->jenis.' berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $bantuan = Bantuan::with('detail')->find($id);
        if($bantuan){
            return view('pages.bantuan.show',compact('bantuan'));
        }

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $bantuan = Bantuan::with(['detail','jenis'])->find($id);
        if($bantuan){
            return view('pages.bantuan.edit',compact('bantuan','id'));
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bantuan = Bantuan::with('detail')->find($id);
        $filename = $bantuan->file;
        $destinationPath = 'uploads';
        if($request->hasFile('file')){
            $file = $request->file('file');
            $file->move($destinationPath,$file->getClientOriginalName());
            $filename = $destinationPath.'/'.$file->getClientOriginalName();
        }
        $bantuan->update([
            'tgl_pengajuan'=>$request->tgl_pengajuan,
            'no_surat'=>$request->no_surat,
            'id_user_input'=>auth()->user()->id,
            'file'=>$filename
        ]);

        $url = '/bantuan?jenis='.$request->jenis;
        return redirect($url)->with(['message'=>'Pengajuan '.$request->jenis.' berhasil ditambahkan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bantuan  $bantuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bantuan $bantuan)
    {
        //
    }

    public function donate(Request $request,$id)
    {
        $bantuan = Bantuan::with(['detail','jenis'])->find($id);
        if($bantuan){
            return view('pages.bantuan.donate',compact('bantuan','id'));
        }

        return abort(404);
    }

    public function bagikanBantuanAction(Request $request)
    {
        if($request->filled("id_penduduk")){
            Bantuan::where('id',$request->id)->update([
                'tgl_penerimaan'=>date('Y-m-d')
            ]);
            DetailBantuan::where('id_penduduk',$request->id_penduduk)->update([
                'status_pengajuan'=> 'Sudah Disalurkan'
            ]);
            Administrasi::where('tracking','Dibuat di Admin Kecamatan')->where('id_penduduk',$request->id_penduduk)->update([
                'status'=>'Sudah Disalurkan'
            ]);
            return 'success2';
        }

        return 'success3';
    }
}
