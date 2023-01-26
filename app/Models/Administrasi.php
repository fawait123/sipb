<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrasi extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'administrasis';
    protected $dates = ['deleted_at'];

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class,'id_penduduk');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class,'id_desa');
    }
}
