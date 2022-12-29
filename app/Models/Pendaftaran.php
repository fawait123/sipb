<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->belongsTo(JenisBantuan::class,'id_jenis_bantuan');
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class,'id_penduduk');
    }
}
