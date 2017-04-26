<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesaTable extends Migration
{
    /**
     * Run the migrations.
     * @table desa
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desa', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('desa', 45)->nullable();
            $table->integer('kecamatan_id')->unsigned();


            $table->foreign('kecamatan_id')
                ->references('id')->on('kecamatan');
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
       Schema::dropIfExists('desa');
     }
}
