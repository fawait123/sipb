<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.agama.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.agama.form');
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
            'agama'=>'required|string'
        ]);
        Agama::create([
            'agama'=>$request->agama
        ]);
        return redirect()->route('agama.index')->with(['message'=>'Tambah data agama berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function show(Agama $agama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function edit(Agama $agama)
    {
        if($agama){
            return view('pages.agama.form',[
                'agama'=>$agama,
                'id'=>$agama->id
            ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agama $agama)
    {
        $request->validate([
            'agama'=>'required|string'
        ]);

        $agama->update([
            'agama'=>$request->agama
        ]);

        return redirect()->route('agama.index')->with(['message'=>'Update data agama berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agama  $agama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agama $agama)
    {
        if($agama){
            $agama->delete();
            return redirect()->route('agama.index')->with(['message'=>'Delete data agama berhasil']);
        }

        return abort(404);
    }
}
