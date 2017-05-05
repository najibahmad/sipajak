<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemKetetapanPajakTable extends Migration
{
    /**
     * Run the migrations.
     * @table item_ketetapan_pajak
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_ketetapan_pajak', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nama_item', 45)->nullable();
            $table->double('volume')->nullable();
            $table->string('satuan', 45)->nullable();
            $table->double('harga')->nullable();
            $table->integer('ketetapan_pajak_id')->unsigned();
            $table->string('status_verifikasi', 45)->nullable();
            $table->string('status_pembayaran', 45)->nullable();
            $table->date('tgl_pembayaran')->nullable();


            $table->foreign('ketetapan_pajak_id')
                ->references('id')->on('ketetapan_pajak');
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
       Schema::dropIfExists('item_ketetapan_pajak');
     }
}
