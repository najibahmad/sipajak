<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWajibPajakTable extends Migration
{
    /**
     * Run the migrations.
     * @table wajib_pajak
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wajib_pajak', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nama', 45)->nullable();
            $table->string('npwp', 45)->nullable();
            $table->text('alamat')->nullable();
            $table->smallInteger('jatuh_tempo')->nullable();
            $table->integer('desa_id')->unsigned();


            $table->foreign('desa_id')
                ->references('id')->on('desa');
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
       Schema::dropIfExists('wajib_pajak');
     }
}
