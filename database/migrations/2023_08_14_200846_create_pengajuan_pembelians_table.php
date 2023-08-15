<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_pembelians', function (Blueprint $table) {
            $table->bigIncrements('id_pengajuanpembelian');
            $table->string('nama_p_dealer');
            $table->date('tanggal_p_dealer');
            $table->string('harga_p_dealer');
            $table->string('nama_pt_karoseri');
            $table->string('tanggal_p_karoseri');
            $table->string('harga_p_karoseri');
            $table->string('dealer');
            $table->string('merk');
            $table->string('tipe');
            $table->string('tahun');
            $table->string('warna');
            $table->string('deskripsi')->nullable();
            $table->string('harga');
            $table->string('bbn');
            $table->string('otr');
            $table->string('karoseri');
            $table->string('total');
            $table->unsignedBigInteger('id_sppk');
            $table->string('approval');
            $table->string('keterangan')->nullable();
            $table->string('status_transaksi');
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
        Schema::dropIfExists('pengajuan_pembelians');
    }
}
