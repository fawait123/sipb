<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pekerjaan as PekerjaanModel;
use Livewire\WithPagination;

class Pekerjaan extends Component
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
        $query = PekerjaanModel::query();
        $query = $query->where('pekerjaan','like','%'.$this->search.'%');
        $query = $query->paginate(10);
        return view('livewire.pekerjaan',compact('query'));
    }
}
