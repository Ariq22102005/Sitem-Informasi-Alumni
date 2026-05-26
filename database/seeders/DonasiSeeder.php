<?php

namespace Database\Seeders;

use App\Models\DonasiAlumni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donasi = [
            [
                'nama_donatur' => 'Budi Santoso',
                'program_studi' => 'Teknik Informatika',
                'jumlah_donasi' => 5000000,
                'catatan' => 'Donasi untuk beasiswa mahasiswa berprestasi',
            ],
            [
                'nama_donatur' => 'Siti Nurhaliza',
                'program_studi' => 'Manajemen',
                'jumlah_donasi' => 3000000,
                'catatan' => 'Donasi untuk pengembangan fasilitas kampus',
            ],
            [
                'nama_donatur' => 'Ahmad Wijaya',
                'program_studi' => 'Akuntansi',
                'jumlah_donasi' => 2500000,
                'catatan' => 'Donasi untuk perpustakaan',
            ],
            [
                'nama_donatur' => 'Rini Handayani',
                'program_studi' => 'Teknik Sipil',
                'jumlah_donasi' => 4000000,
                'catatan' => 'Donasi untuk research and development',
            ],
            [
                'nama_donatur' => 'Dody Firmansyah',
                'program_studi' => 'Sistem Informasi',
                'jumlah_donasi' => 6000000,
                'catatan' => 'Donasi untuk laboratorium komputer',
            ],
        ];

        foreach ($donasi as $item) {
            DonasiAlumni::create($item);
        }
    }
}
