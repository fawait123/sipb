<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Bantuan as BantuanModel;
use Livewire\WithPagination;
use App\Models\Administrasi;


class Bantuan extends Component
{
    use WithPagination;
    public $search = '';
    public $jenis = '';

    protected $queryString = ['search', 'jenis'];

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
            $qr->where('nama_bantuan',$this->jenis);
        });
        if($this->search != ''){
            $query = $query->where('no_surat','like','%'.$this->search.'%')->whereHas('jenis',function($qr){
                $qr->where('nama_bantuan','PKH');
            });
        }
        $query = $query->paginate(10);
        $jenis = $this->jenis;
        $count = Administrasi::with('penduduk')->where('status','Lolos')->where('konfirmasi',1)->where('jenis_bantuan',$this->jenis)->count();
        return view('livewire.bantuan',compact('query','jenis','count'));
    }
}
