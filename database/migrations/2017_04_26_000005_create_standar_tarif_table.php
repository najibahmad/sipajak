<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandarTarifTable extends Migration
{
    /**
     * Run the migrations.
     * @table standar_tarif
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standar_tarif', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nama_item', 45)->nullable();
            $table->string('satuan', 45)->nullable();
            $table->double('tarif')->nullable();
            $table->date('tahun')->nullable();
            $table->integer('jenis_pajak_id')->unsigned();

            $table->foreign('jenis_pajak_id')->references('id')->on('jenis_pajak');
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
       Schema::dropIfExists('standar_tarif');
     }
}
