<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumni extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama', 'nim', 'email', 'no_hp', 'program_studi',
        'angkatan', 'tahun_lulus', 'ipk',
        'status_kerja', 'perusahaan', 'alamat',
    ];

    public function tracerStudy()
    {
        return $this->hasOne(TracerStudy::class);
    }
}
