<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonasiAlumni extends Model
{
    // Baris ini mengunci nama tabel agar tepat mendasar pada nama tabel di database
    protected $table = 'donasi_alumnis'; 

    // Mengizinkan kolom diisi melalui query massal
    protected $fillable = ['nama_donatur', 'program_studi', 'jumlah_donasi', 'catatan'];
}