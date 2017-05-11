<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    /*
    protected $table = 'pegawai';

    protected $fillable = [
        'id',
        'nama',
        'nip',
        'alamat',
        'hp',
        'status',
        'nomor_sk',
    ];
    */
    protected $table = 'pegawai';

    protected $fillable = [
        'id',
        'user_id',
        'nama',
        'nip',
        'alamat',
        'hp',
        'status',
        'nomor_sk',
    ];
}
