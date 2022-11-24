<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBantuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bantuans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_penduduk');
            $table->integer('id_bantuan');
            $table->string('status_pengajuan');
            $table->integer('id_user_verifikator');
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
        Schema::dropIfExists('detail_bantuans');
    }
}
