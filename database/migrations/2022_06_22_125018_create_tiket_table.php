<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tiket');
            $table->float('harga');
            $table->text('deskripsi');
            $table->string('status');
            $table->dateTime('tgl_carter');
            $table->string('kode');
            $table->string('kloter');
            $table->bigInteger('id_kategori');

            $table->softDeletes();
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
        Schema::dropIfExists('tiket');
    }
}
