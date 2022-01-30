<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukrugilabaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produkrugilaba', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tgl');
            $table->string('produk_id')->nullable();
            // $table->string('jml_produk_diolah_perbulan')->nullable();
            // $table->string('jml_produk_terjual_perbulan')->nullable();
            // $table->string('jml_rugilaba')->nullable();
            $table->string('jml_terjual')->nullable();
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
        Schema::dropIfExists('produkrugilaba');
    }
}
