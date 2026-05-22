<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TracerStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_id',
        'nama_alumni',
        'angkatan',
        'status_kerja',
        'perusahaan',
        'jabatan',
        'bidang_pekerjaan',
        'gaji_awal',
        'bulan_tunggu_kerja',
        'relevan_dengan_studi',
        'komentar',
    ];

    protected $casts = [
        'relevan_dengan_studi' => 'boolean',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}