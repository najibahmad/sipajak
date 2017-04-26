<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    //
    protected $table = 'desa';

    protected $fillable = [
        'desa',
        'kecamatan_id',
    ];

    public function kecamatan(){
      return $this->belongsTo('App\Kecamatan','kecamatan_id');
    }
}
