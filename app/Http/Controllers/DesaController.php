<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.desa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::get();
        $kabupaten = Kabupaten::get();
        return view('pages.desa.form',[
            'kabupaten'=>$kabupaten,
            'kecamatan'=>$kecamatan
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
            'kecamatan'=>'required',
            'kabupaten' =>'required',
            'desa'=>'required',
        ]);
        Desa::create([
            'id_kecamatan'=>$request->kecamatan,
            'id_kabupaten'=>$request->kabupaten,
            'desa'=>$request->desa
        ]);

        return redirect()->route('desa.index')->with(['message'=>'Tambah data desa berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa)
    {
        if($desa){
            $kecamatan = Kecamatan::get();
            $kabupaten = Kabupaten::get();
            return view('pages.desa.form',[
                'kabupaten'=>$kabupaten,
                'kecamatan'=>$kecamatan,
                'desa'=>$desa,
                'id'=>$desa->id
            ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa)
    {
        $request->validate([
            'kecamatan'=>'required',
            'kabupaten' =>'required',
            'desa'=>'required',
        ]);
        $desa->update([
            'id_kecamatan'=>$request->kecamatan,
            'id_kabupaten'=>$request->kabupaten,
            'desa'=>$request->desa
        ]);

        return redirect()->route('desa.index')->with(['message'=>'Update data desa berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa)
    {
        if($desa){
            $desa->delete();
            return redirect()->route('desa.index')->with(['message'=>'Hapus data desa berhasil']);
        }

        return abort(404);
    }
}
