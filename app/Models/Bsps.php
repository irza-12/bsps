<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bsps extends Model
{
    protected $table = 'bsps';

    protected $fillable = [
        'no_kk',
        'nik',
        'nama',
        'alamat',
        'dusun',
        'rt',
        'tahun',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];
}
