<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WajibPajak extends Model
{
    //
    protected $table = 'wajib_pajak';

    protected $fillable = [
        'id',
        'nama',
        'npwp',
        'alamat',
        'jatuh_tempo',
        'desa_id',
    ];
    use SoftDeletes;
    protected $dates=['deleted_at'];
    
    public function ketetapan_pajak(){
      return $this->hasMany('App\KetetapanPajak','wajib_pajak_id','id');
    }

    public function desa(){
      return $this->belongsTo('App\Desa','desa_id');
    }
}
