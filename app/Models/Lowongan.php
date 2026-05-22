<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lowongan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'posisi', 'perusahaan', 'tipe', 'lokasi', 'gaji',
        'batas_lamar', 'link_lamar', 'kontak',
        'deskripsi', 'kualifikasi', 'status',
    ];

    protected $casts = [
        'batas_lamar' => 'date',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}