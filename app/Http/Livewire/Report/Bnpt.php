<?php

namespace App\Http\Livewire\Report;

use App\Models\DetailBantuan as DetailBantuanModel;
use Livewire\WithPagination;
use App\Exports\BantuanBpnt;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;

class Bnpt extends Component
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
            $qr->where('nama_bantuan','BPNT');
        });
        if($this->search != ''){
            $query = $query->whereHas('bantuan',function($qr){
                $qr->where('no_surat','like','%'.$this->search.'%');
            })->orWhereHas('penduduk',function($qr){
                $qr->where('nama','like','%'.$this->search.'%');
            })->whereHas('bantuan.jenis',function($qr){
                $qr->where('nama_bantuan','BPNT');
            });
        }
        $query = $query->paginate(10);
        return view('livewire.report.bnpt',compact('query'));
    }

    public function download()
    {
        return Excel::download(new BantuanBpnt($this->search), 'laporan-bantuan-bpnt.xlsx');
    }
}
