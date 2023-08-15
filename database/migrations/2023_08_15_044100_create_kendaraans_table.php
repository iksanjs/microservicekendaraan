<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_polisi')->unique();
            $table->string('kategori');
            $table->string('merk');
            $table->string('tipe');
            $table->string('tahun');
            $table->string('warna');
            $table->date('tanggal_beli');
            $table->string('harga_off');
            $table->string('bbn');
            $table->string('otr');
            $table->string('karoseri');
            $table->string('total');
            $table->string('no_rangka');
            $table->string('no_mesin');
            $table->string('lokasi');
            $table->string('status');
            $table->string('approval');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('kendaraans');
    }
}
