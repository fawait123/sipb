<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_keluarga');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->enum('jk',['laki-laki','perempuan']);
            $table->text('alamat');
            $table->enum('status_kawin',['kawin','belum kawin']);
            $table->enum('kewarganegaraan',['WNI','WNA']);
            $table->string('goldar');
            $table->string('nama_ibu');
            $table->string('nama_ayah');
            $table->string('pendidikan_terakhir');
            $table->integer('id_agama');
            $table->integer('id_pekerjaan');
            $table->integer('id_desa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penduduks');
    }
}
