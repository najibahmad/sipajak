<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekeningPenerimaan extends Model
{
    //
    protected $table = 'rekening_penerimaan';

    protected $fillable = [
        'id',
        'nomor_rekening',
        'uraian',
    ];

    public function ketetapan_pajak(){
      return $this->hasMany('App\KetetapanPajak','rekening_penerimaan_id','id');
    }
}
