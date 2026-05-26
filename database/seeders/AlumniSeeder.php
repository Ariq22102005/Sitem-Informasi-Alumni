<?php

namespace Database\Seeders;

use App\Models\Alumni;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumni = [
            [
                'nama' => 'Budi Santoso',
                'nim' => '18101001',
                'email' => 'budi@example.com',
                'no_hp' => '081234567890',
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2018',
                'tahun_lulus' => '2022',
                'ipk' => 3.75,
                'status_kerja' => 'Bekerja',
                'perusahaan' => 'PT. Teknologi Indonesia',
                'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'nim' => '18102001',
                'email' => 'siti@example.com',
                'no_hp' => '081345678901',
                'program_studi' => 'Manajemen',
                'angkatan' => '2018',
                'tahun_lulus' => '2022',
                'ipk' => 3.65,
                'status_kerja' => 'Bekerja',
                'perusahaan' => 'PT. Konsultan Bisnis',
                'alamat' => 'Jl. Sudirman No. 456, Bandung',
            ],
            [
                'nama' => 'Ahmad Wijaya',
                'nim' => '18103001',
                'email' => 'ahmad@example.com',
                'no_hp' => '081456789012',
                'program_studi' => 'Akuntansi',
                'angkatan' => '2018',
                'tahun_lulus' => '2022',
                'ipk' => 3.55,
                'status_kerja' => 'Bekerja',
                'perusahaan' => 'Kantor Akuntan Publik',
                'alamat' => 'Jl. Gatot Subroto No. 789, Surabaya',
            ],
            [
                'nama' => 'Rini Handayani',
                'nim' => '19101001',
                'email' => 'rini@example.com',
                'no_hp' => '081567890123',
                'program_studi' => 'Teknik Sipil',
                'angkatan' => '2019',
                'tahun_lulus' => '2023',
                'ipk' => 3.45,
                'status_kerja' => 'Bekerja',
                'perusahaan' => 'PT. Konstruksi Bangunan',
                'alamat' => 'Jl. Ahmad Yani No. 321, Medan',
            ],
            [
                'nama' => 'Dody Firmansyah',
                'nim' => '19102001',
                'email' => 'dody@example.com',
                'no_hp' => '081678901234',
                'program_studi' => 'Sistem Informasi',
                'angkatan' => '2019',
                'tahun_lulus' => '2023',
                'ipk' => 3.70,
                'status_kerja' => 'Bekerja',
                'perusahaan' => 'PT. Software Developer',
                'alamat' => 'Jl. Diponegoro No. 654, Yogyakarta',
            ],
        ];

        foreach ($alumni as $item) {
            Alumni::create($item);
        }
    }
}
