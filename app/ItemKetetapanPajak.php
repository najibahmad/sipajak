<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    use SoftDeletes;
    protected $dates=['deleted_at'];

    public function ketetapan_pajak(){
      return $this->belongsTo('App\KetetapanPajak','ketetapan_pajak_id');
    }
}
