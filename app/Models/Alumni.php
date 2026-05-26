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
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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