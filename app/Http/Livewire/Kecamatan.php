<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kecamatan as KecamatanModel;
use Livewire\WithPagination;
class Kecamatan extends Component
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
        $query = KecamatanModel::query();
        $query = $query->with('kabupaten');
        $query = $query->where('kecamatan','like','%'.$this->search.'%')->orWhereHas('kabupaten',function($qr){
            $qr->where('kabupaten','like','%'.$this->search.'%');
        });
        $query = $query->paginate(10);
        return view('livewire.kecamatan',compact('query'));
    }
}
