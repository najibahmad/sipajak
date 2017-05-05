<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekeningPenerimaan extends Model
{
    //
    protected $table = 'rekening_penerimaan';

    protected $fillable = [
        'id',
        'nomor_rekening',
        'uraian',
    ];
    use SoftDeletes;
    protected $dates=['deleted_at'];

    public function ketetapan_pajak(){
      return $this->hasMany('App\KetetapanPajak','rekening_penerimaan_id','id');
    }
}
