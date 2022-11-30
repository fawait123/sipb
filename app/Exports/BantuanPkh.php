<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\DetailBantuan;

class BantuanPkh implements FromView
{
    public function __construct($search)
    {
        $this->search = $search;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $query = DetailBantuan::query();
        $query = $query->with(['penduduk','bantuan.jenis','verifikator']);
        $query = $query->whereHas('bantuan.jenis',function($qr){
            $qr->where('nama_bantuan','PKH');
        });
        if($this->search != ''){
            $query = $query->whereHas('bantuan',function($qr){
                $qr->where('no_surat','like','%'.$this->search.'%');
            })->orWhereHas('penduduk',function($qr){
                $qr->where('nama','like','%'.$this->search.'%');
            })->whereHas('bantuan.jenis',function($qr){
                $qr->where('nama_bantuan','PKH');
            });
        }
        return view('exports.pkh', [
            'query' => $query->get(),
        ]);
    }
}
