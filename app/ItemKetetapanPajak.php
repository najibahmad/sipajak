<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemKetetapanPajak extends Model
{
    //
    protected $table = 'item_ketetapan_pajak';

    protected $fillable = [
        'id',
        'nama_item',
        'volume',
        'satuan',
        'harga',
        'ketetapan_pajak_id',
        'status_verifikasi',
        'status_pembayaran',
        'tgl_pembayaran',
    ];

    public function ketetapan_pajak(){
      return $this->belongsTo('App\KetetapanPajak','ketetapan_pajak_id');
    }
}
