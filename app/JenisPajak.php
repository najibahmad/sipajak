<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPajak extends Model
{
    //
    protected $table = 'jenis_pajak';

    protected $fillable = [
        'id',
        'jenis',
    ];

    public function ketetapan_pajak(){
      return $this->hasMany('App\KetetapanPajak','jenis_pajak_id','id');
    }

}
