<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StandarTarif extends Model
{
    //
    protected $table = 'standar_tarif';

    protected $fillable = [
        'id',
        'nama_item',
        'satuan',
        'tarif',
        'tahun',
        'jenis_pajak_id',
    ];

    public function jenis_pajak(){
      return $this->belongsTo('App\JenisPajak','jenis_pajak_id');
    }
}
