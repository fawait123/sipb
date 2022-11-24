<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Desa as DesaModel;
use Livewire\WithPagination;

class Desa extends Component
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
        $query = DesaModel::query();
        $query = $query->with('kecamatan.kabupaten');
        $query = $query->where('desa','like','%'.$this->search.'%')->orWhereHas('kecamatan',function($qr){
            $qr->where('kecamatan','like','%'.$this->search.'%');
        })->orWhereHas('kecamatan.kabupaten',function($qr){
            $qr->where('kabupaten','like','%'.$this->search.'%');
        });
        $query = $query->paginate(10);
        return view('livewire.desa',compact('query'));
    }
}
