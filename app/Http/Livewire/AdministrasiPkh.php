<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Administrasi as AdministrasiModel;

class AdministrasiPkh extends Component
{
    public $jenis = '';
    public $search = '';

    protected $queryString = ['jenis'];

    public function render()
    {
        $query = AdministrasiModel::query();
        $query = $query->with('desa');
        $query = $query->where('jenis_bantuan',$this->jenis)->where('id_desa',auth()->user()->id_desa);
        if($this->search != ''){
            $query = $query->where('nama','like','%'.$this->search.'%');
        }
        $query = $query->paginate(10);
        $jenis = $this->jenis;
        $count =  AdministrasiModel::where('jenis_bantuan',$this->jenis)->where('id_desa',auth()->user()->id_desa)->where('status','Lolos')->where('konfirmasi',0)->count();
        return view('livewire.administrasi-pkh',compact('query','jenis','count'));
    }
}
