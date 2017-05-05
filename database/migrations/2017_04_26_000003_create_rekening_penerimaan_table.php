<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekeningPenerimaanTable extends Migration
{
    /**
     * Run the migrations.
     * @table rekening_penerimaan
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekening_penerimaan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nomor_rekening', 45)->nullable();
            $table->string('uraian')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('rekening_penerimaan');
     }
}
