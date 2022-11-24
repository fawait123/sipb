<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.kabupaten.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kabupaten.form');
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
            'kabupaten' =>'required|string'
        ]);

        Kabupaten::create([
            'kabupaten' => $request->kabupaten
        ]);

        return redirect()->route('kabupaten.index')->with(['message'=>'Tambah data kabupaten berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function show(Kabupaten $kabupaten)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function edit(Kabupaten $kabupaten)
    {
        if($kabupaten){
            return view('pages.kabupaten.form',[
                'kabupaten' => $kabupaten,
                'id' =>$kabupaten->id
            ]);
        }

        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $request->validate([
            'kabupaten' =>'required|string'
        ]);

        $kabupaten->update([
            'kabupaten' => $request->kabupaten
        ]);

        return redirect()->route('kabupaten.index')->with(['message'=>'Update data kabupaten berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kabupaten  $kabupaten
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kabupaten $kabupaten)
    {
        if($kabupaten){
            $kabupaten->delete();
            return redirect()->route('kabupaten.index')->with(['message'=>'Hapus data kabupaten berhasil']);
        }

        return abort(404);
    }
}
