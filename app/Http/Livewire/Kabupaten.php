<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kabupaten as KabupatenModel;
use Livewire\WithPagination;

class Kabupaten extends Component
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
        $query = KabupatenModel::query();
        $query = $query->where('kabupaten','like','%'.$this->search.'%');
        $query = $query->paginate(10);
        return view('livewire.kabupaten',compact('query'));
    }
}
