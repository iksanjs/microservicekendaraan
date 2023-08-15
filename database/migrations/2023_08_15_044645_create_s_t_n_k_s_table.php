<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSTNKSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_t_n_k_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_polisi');
            $table->foreign('no_polisi')->references('no_polisi')->on('kendaraans')->onDelete('cascade');
            $table->date('tanggal_jt_stnk');
            $table->date('tanggal_bayar_stnk');
            $table->string('biaya_stnk');
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
        Schema::dropIfExists('s_t_n_k_s');
    }
}
