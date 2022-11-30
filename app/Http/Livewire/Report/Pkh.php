<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\DetailBantuan as DetailBantuanModel;
use Livewire\WithPagination;
use App\Exports\BantuanPkh;
use Maatwebsite\Excel\Facades\Excel;

class Pkh extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $query = DetailBantuanModel::query();
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
        $query = $query->paginate(10);
        return view('livewire.report.pkh',compact('query'));
    }

    public function download()
    {
        return Excel::download(new BantuanPkh($this->search), 'laporan-bantuan-pkh.xlsx');
    }
}
