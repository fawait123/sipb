<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.kecamatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kabupaten = Kabupaten::get();
        return view('pages.kecamatan.form',[
            'kabupaten' => $kabupaten
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
            'kabupaten'=>'required',
            'kecamatan'=>'required',
        ]);

        Kecamatan::create([
            'kecamatan'=>$request->kecamatan,
            'id_kabupaten'=>$request->kabupaten
        ]);

        return redirect()->route('kecamatan.index')->with(['message'=>'Tambah data kecamatan berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function show(Kecamatan $kecamatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kecamatan $kecamatan)
    {
        if($kecamatan){
            $kabupaten = Kabupaten::get();
            return view('pages.kecamatan.form',[
                'kecamatan'=>$kecamatan,
                'kabupaten'=>$kabupaten,
                'id'=>$kecamatan->id
            ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'kabupaten'=>'required',
            'kecamatan'=>'required',
        ]);

        $kecamatan->update([
            'kecamatan'=>$request->kecamatan,
            'id_kabupaten'=>$request->kabupaten
        ]);

        return redirect()->route('kecamatan.index')->with(['message'=>'Update data kecamatan berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kecamatan  $kecamatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kecamatan $kecamatan)
    {
        if($kecamatan){
            $kecamatan->delete();
            return redirect()->route('kecamatan.index')->with(['message'=>'Hapus data kecamatan berhasil']);
        }

        return abort(404);
    }
}
