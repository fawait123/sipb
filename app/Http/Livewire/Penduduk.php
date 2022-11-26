<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Penduduk as PendudukModel;
use Livewire\WithPagination;

class Penduduk extends Component
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
        $query = PendudukModel::query();
        $query = $query->with(['desa.kecamatan.kabupaten','agama','pekerjaan']);
        $query = $query->where('nik','like','%'.$this->search.'%')->orWhere('nama','like','%'.$this->search.'%')->orWhere('kewarganegaraan','like','%'.$this->search.'%')->orWhereHas('desa',function($qr){
            $qr->where('desa','like','%'.$this->search.'%');
        });
        $query = $query->paginate(10);
        return view('livewire.penduduk',compact('query'));
    }
}
