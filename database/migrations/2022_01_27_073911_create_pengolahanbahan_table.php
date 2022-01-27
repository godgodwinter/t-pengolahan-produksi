<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengolahanbahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengolahanbahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tgl')->nullable();
            $table->string('hasilpanen_id')->nullable();
            $table->string('waktupengolahan')->nullable();
            $table->string('jml_pengolahan')->nullable();
            $table->string('hasil_pengolahan')->nullable();
            $table->string('produk_id')->nullable();
            $table->string('jml')->nullable();
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
        Schema::dropIfExists('pengolahanbahan');
    }
}
