<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KetetapanPajak extends Model
{
    //
    protected $table = 'ketetapan_pajak';

    protected $fillable = [
        'id',
        'bulan',
        'tahun',
        'jatuh_tempo',
        'nama_pekerjaan',
        'wajib_pajak_id',
        'rekening_penerimaan_id',
        'jenis_pajak_id',
    ];

    public function wajib_pajak(){
      return $this->belongsTo('App\WajibPajak','wajib_pajak_id');
    }

    public function rekening_penerimaan(){
      return $this->belongsTo('App\RekeningPenerimaan','rekening_penerimaan_id');
    }

    public function jenis_pajak(){
      return $this->belongsTo('App\JenisPajak','jenis_pajak_id');
    }

    public function item_ketetapan_pajak(){
      return $this->hasMany('App\ItemKetetapanPajak','ketetapan_pajak_id','id');
    }




}
