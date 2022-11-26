<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function desa()
    {
        return $this->belongsTo(Desa::class,'id_desa');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class,'id_pekerjaan');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class,'id_agama');
    }
}
