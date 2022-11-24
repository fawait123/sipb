<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.pekerjaan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pekerjaan.form');
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
            'pekerjaan'=>'required|string'
        ]);

        Pekerjaan::create([
            'pekerjaan'=>$request->pekerjaan
        ]);

        return redirect()->route('pekerjaan.index')->with(['message'=>'Tambah data pekerjaan berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        if($pekerjaan){
            return view('pages.pekerjaan.form',[
                'pekerjaan'=>$pekerjaan,
                'id'=>$pekerjaan->id
            ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $request->validate([
            'pekerjaan'=>'required|string'
        ]);

        $pekerjaan->update([
            'pekerjaan'=>$request->pekerjaan
        ]);

        return redirect()->route('pekerjaan.index')->with(['message'=>'Update data pekerjaan berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        if($pekerjaan){
            $pekerjaan->delete();
            return redirect()->route('pekerjaan.index')->with(['message'=>'Hapus data pekerjaan berhasil']);
        }

        return abort(404);
    }
}
