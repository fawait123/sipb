<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function penduduks()
    {
        return $this->hasMany(Penduduk::class,'id_keluarga');
    }
}
