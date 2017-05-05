<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPajak extends Model
{
    //
    protected $table = 'jenis_pajak';

    protected $fillable = [
        'id',
        'jenis',
    ];

    use SoftDeletes;
    protected $dates=['deleted_at'];

    public function ketetapan_pajak(){
      return $this->hasMany('App\KetetapanPajak','jenis_pajak_id','id');
    }

}
