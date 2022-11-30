<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBantuan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class,'id_penduduk');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class,'id_user_verifikator');
    }

    public function bantuan()
    {
        return $this->belongsTo(Bantuan::class,'id_bantuan');
    }
}
