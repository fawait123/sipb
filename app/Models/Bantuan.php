<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    use HasFactory;


    protected $guarded = ['id'];
    protected $table = 'bantuans';


    public function jenis()
    {
        return $this->belongsTo(JenisBantuan::class,'id_jenis_bantuan');
    }


    public function userInput()
    {
        return $this->belongsTo(User::class,'id_user_input');
    }

    public function detail()
    {
        return $this->hasMany(DetailBantuan::class,'id_bantuan');
    }
}
