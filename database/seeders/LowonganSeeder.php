<?php

namespace Database\Seeders;

use App\Models\Lowongan;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            [
                'posisi' => 'Web Developer',
                'perusahaan' => 'PT Teknologi Nusantara',
                'tipe' => 'full_time',
                'lokasi' => 'Jakarta',
                'gaji' => 'Rp 8.000.000 - 12.000.000',
                'batas_lamar' => now()->addMonth(),
                'link_lamar' => 'https://example.com/lamar/web-dev',
                'kontak' => 'hr@teknusantara.co.id',
                'deskripsi' => "Mengembangkan aplikasi web menggunakan Laravel dan Vue.js.\nBerkolaborasi dengan tim produk untuk merilis fitur baru.",
                'kualifikasi' => "S1 Teknik Informatika atau sejenisnya.\nPengalaman minimal 1 tahun.\nMenguasai PHP, JavaScript, dan Git.",
                'status' => 'aktif',
            ],
            [
                'posisi' => 'Data Analyst Intern',
                'perusahaan' => 'Startup Analytics ID',
                'tipe' => 'magang',
                'lokasi' => 'Bandung',
                'gaji' => 'Uang saku + transport',
                'batas_lamar' => now()->addWeeks(3),
                'kontak' => '081234567890',
                'deskripsi' => 'Membantu tim analisis data dalam menyusun laporan dan dashboard bisnis.',
                'kualifikasi' => "Mahasiswa semester akhir.\nFamiliar dengan Excel dan SQL dasar.",
                'status' => 'aktif',
            ],
            [
                'posisi' => 'UI/UX Designer (Freelance)',
                'perusahaan' => 'Creative Studio Alumni',
                'tipe' => 'freelance',
                'lokasi' => 'Remote',
                'gaji' => 'Per proyek',
                'batas_lamar' => now()->addWeeks(2),
                'deskripsi' => 'Merancang wireframe dan prototipe untuk aplikasi mobile edukasi.',
                'kualifikasi' => "Portfolio desain UI/UX.\nMenguasai Figma.",
                'status' => 'aktif',
            ],
            [
                'posisi' => 'Admin Operasional',
                'perusahaan' => 'CV Logistik Maju',
                'tipe' => 'part_time',
                'lokasi' => 'Surabaya',
                'gaji' => 'Rp 4.000.000',
                'batas_lamar' => now()->subWeek(),
                'deskripsi' => 'Lowongan contoh yang sudah kedaluwarsa.',
                'status' => 'tutup',
            ],
        ];

        foreach ($samples as $data) {
            Lowongan::create($data);
        }
    }
}
