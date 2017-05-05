<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    use SoftDeletes;
    protected $dates=['deleted_at'];

    public function jenis_pajak(){
      return $this->belongsTo('App\JenisPajak','jenis_pajak_id');
    }
}
