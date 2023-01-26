<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Administrasi;
use App\Models\Penduduk;

class BantuanCreate extends Component
{
    public $jenis = '';

    public $queryString = ['jenis'];
    public function render()
    {
        $pendaftaran = Administrasi::with('penduduk')->where('status','Lolos')->where('konfirmasi',1)->where('tracking','Dikonfirmasi Admin Desa')->where('jenis_bantuan',$this->jenis)->get();
        $penduduk = Penduduk::with('agama')->get();
        $jenis = $this->jenis;
        return view('livewire.bantuan-create',compact('pendaftaran','penduduk','jenis'));
    }
}
