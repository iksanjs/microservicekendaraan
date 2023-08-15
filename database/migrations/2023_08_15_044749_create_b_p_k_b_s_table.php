<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBPKBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_p_k_b_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_polisi');
            $table->foreign('no_polisi')->references('no_polisi')->on('kendaraans')->onDelete('cascade');
            $table->string('nama_bpkb');
            $table->string('posisi_bpkb');
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
        Schema::dropIfExists('b_p_k_b_s');
    }
}
