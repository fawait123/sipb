<?php

namespace App\Http\Livewire\Bantuan;

use Livewire\Component;
use App\Models\Bantuan as BantuanModel;
use Livewire\WithPagination;

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
        $query = BantuanModel::query();
        $query = $query->with(['jenis','userInput']);
        $query = $query->whereHas('jenis',function($qr){
            $qr->where('nama_bantuan','BPNT');
        });
        if($this->search != ''){
            $query = $query->where('no_surat','like','%'.$this->search.'%')->whereHas('jenis',function($qr){
                $qr->where('nama_bantuan','BPNT');
            });
        }
        $query = $query->paginate(10);
        return view('livewire.bantuan.bnpt',compact('query'));
    }
}
