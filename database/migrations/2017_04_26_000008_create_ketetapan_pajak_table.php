<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKetetapanPajakTable extends Migration
{
    /**
     * Run the migrations.
     * @table ketetapan_pajak
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ketetapan_pajak', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('bulan', 45)->nullable();
            $table->smallInteger('tahun')->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->string('nama_pekerjaan', 45)->nullable();
            $table->string('keterangan_pekerjaan', 45)->nullable();
            $table->integer('wajib_pajak_id')->unsigned();
            $table->integer('rekening_penerimaan_id')->unsigned();
            $table->integer('jenis_pajak_id')->unsigned();


            $table->foreign('wajib_pajak_id')
                ->references('id')->on('wajib_pajak');

            $table->foreign('rekening_penerimaan_id')
                ->references('id')->on('rekening_penerimaan');

            $table->foreign('jenis_pajak_id')
                ->references('id')->on('jenis_pajak');

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
       Schema::dropIfExists('ketetapan_pajak');
     }
}
