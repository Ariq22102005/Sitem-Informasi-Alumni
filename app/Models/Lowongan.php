<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lowongan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'posisi',
        'perusahaan',
        'tipe',
        'lokasi',
        'gaji',
        'batas_lamar',
        'link_lamar',
        'kontak',
        'deskripsi',
        'kualifikasi',
        'status',
    ];

    protected $casts = [
        'batas_lamar' => 'date',
    ];

    public const TIPE_OPTIONS = [
        'full_time' => 'Full Time',
        'part_time' => 'Part Time',
        'magang' => 'Magang',
        'freelance' => 'Freelance',
    ];

    public function scopeAktif(Builder $query): Builder
    {
        return $query
            ->where('status', 'aktif')
            ->where(function (Builder $q) {
                $q->whereNull('batas_lamar')
                    ->orWhereDate('batas_lamar', '>=', now()->toDateString());
            });
    }

    public function getTipeLabelAttribute(): string
    {
        return self::TIPE_OPTIONS[$this->tipe] ?? ucfirst((string) $this->tipe);
    }

    public function isMasihDibuka(): bool
    {
        if ($this->status !== 'aktif') {
            return false;
        }

        if ($this->batas_lamar === null) {
            return true;
        }

        return $this->batas_lamar->gte(now()->startOfDay());
    }
}
