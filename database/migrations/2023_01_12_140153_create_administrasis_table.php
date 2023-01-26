<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrasis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_desa');
            $table->integer('id_penduduk');
            $table->string('nik');
            $table->string('nama');
            $table->string('jk');
            $table->string('alamat');
            $table->string('status_kawin');
            $table->longText('foto_ktp');
            $table->longText('foto_penghasilan');
            $table->timestamps();
            $table->timestamp('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrasis');
    }
}
