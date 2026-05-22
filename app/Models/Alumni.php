<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'jurusan',
        'angkatan',
        'tahun_lulus',
        'email',
        'pekerjaan',
        'alamat'
    ];
}