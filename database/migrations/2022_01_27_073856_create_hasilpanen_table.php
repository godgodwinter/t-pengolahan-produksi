<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilpanenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasilpanen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bahan_id');
            $table->string('tgl_pelaporan')->nullable();
            $table->string('petani_id')->nullable();
            $table->string('waktu_panen')->nullable();
            $table->string('jml')->nullable();
            $table->string('kualitas')->nullable();
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
        Schema::dropIfExists('hasilpanen');
    }
}
