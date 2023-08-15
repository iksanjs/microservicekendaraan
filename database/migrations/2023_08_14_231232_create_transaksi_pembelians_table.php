<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pembelians', function (Blueprint $table) {
            $table->bigIncrements('id_transaksipembelian');
            $table->date('tanggal_transaksi_p');
            $table->string('pembayaran_transaksi_p');
            $table->string('bukti_transaksi_p');
            $table->unsignedBigInteger('id_pengajuanpembelian');
            $table->foreign('id_pengajuanpembelian')->references('id_pengajuanpembelian')->on('pengajuan_pembelians')->onDelete('cascade');
            $table->string('id_sppk');
            $table->string('approval');
            $table->string('keterangan')->nullable();
            $table->string('status_st');
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
        Schema::dropIfExists('transaksi_pembelians');
    }
}
