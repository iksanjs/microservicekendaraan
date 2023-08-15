<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSTDealertoWahanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_t_dealerto_wahanas', function (Blueprint $table) {
            $table->bigIncrements('id_stdealertowahana');
            $table->date('tgl_st');
            $table->string('nama_penyerah');
            $table->string('nama_penerima');
            $table->unsignedBigInteger('id_pengajuanpembelian');
            $table->foreign('id_pengajuanpembelian')->references('id_pengajuanpembelian')->on('pengajuan_pembelians')->onDelete('cascade');
            $table->string('no_polisi');
            $table->foreign('no_polisi')->references('no_polisi')->on('kendaraans')->onDelete('cascade');
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
        Schema::dropIfExists('s_t_dealerto_wahanas');
    }
}
