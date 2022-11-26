<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Keluarga as KeluargaModel;
use Livewire\WithPagination;

class Keluarga extends Component
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
        $query = KeluargaModel::query();
        $query = $query->with('penduduks');
        $query = $query->where('kepala_keluarga','like','%'.$this->search.'%')->orWhere('no_kk','like','%'.$this->search.'%');
        $query = $query->paginate(10);
        return view('livewire.keluarga',compact('query'));
    }
}
