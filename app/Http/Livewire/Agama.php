<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Agama as AgamaModel;
use Livewire\WithPagination;

class Agama extends Component
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
        $query = AgamaModel::query();
        $query = $query->where('agama','like','%'.$this->search.'%');
        $query = $query->paginate(10);
        return view('livewire.agama',compact('query'));
    }
}
