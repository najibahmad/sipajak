<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
    protected $table = 'kecamatan';

    protected $fillable = [
        'id',
        'kecamatan',
    ];

    public function desa(){
      return $this->hasMany('App\Desa','kecamatan_id','id');
    }
}
