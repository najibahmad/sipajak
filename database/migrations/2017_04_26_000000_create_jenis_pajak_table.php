<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisPajakTable extends Migration
{
    /**
     * Run the migrations.
     * @table jenis_pajak
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_pajak', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('jenis', 45)->nullable();
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
       Schema::dropIfExists('jenis_pajak');
     }
}
