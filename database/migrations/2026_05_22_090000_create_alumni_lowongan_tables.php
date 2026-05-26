<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── TABLE ALUMNI ────────────────────────────────────────────
        if (! Schema::hasTable('alumni')) {
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();
            $table->string('program_studi');
            $table->integer('angkatan');
            $table->integer('tahun_lulus')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->enum('status_kerja', ['bekerja', 'wirausaha', 'melanjutkan_studi', 'belum_bekerja'])->nullable();
            $table->string('perusahaan')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        }

        // ── TABLE LOWONGAN ──────────────────────────────────────────
        if (! Schema::hasTable('lowongans')) {
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->string('posisi');
            $table->string('perusahaan');
            $table->enum('tipe', ['full_time', 'part_time', 'magang', 'freelance'])->default('full_time');
            $table->string('lokasi')->nullable();
            $table->string('gaji')->nullable();
            $table->date('batas_lamar')->nullable();
            $table->string('link_lamar')->nullable();
            $table->string('kontak')->nullable();
            $table->text('deskripsi');
            $table->text('kualifikasi')->nullable();
            $table->enum('status', ['aktif', 'tutup'])->default('aktif');
            $table->timestamps();
            $table->softDeletes();
        });
        }

        // ── TABLE TRACER STUDY ──────────────────────────────────────
        if (! Schema::hasTable('tracer_studies')) {
        Schema::create('tracer_studies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->nullable()->constrained('alumni')->nullOnDelete();
            $table->string('nama_alumni')->nullable();
            $table->integer('angkatan')->nullable();
            $table->enum('status_kerja', ['bekerja', 'wirausaha', 'melanjutkan_studi', 'belum_bekerja'])->nullable();
            $table->string('perusahaan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('bidang_pekerjaan')->nullable();
            $table->integer('gaji_awal')->nullable();
            $table->integer('bulan_tunggu_kerja')->nullable();
            $table->boolean('relevan_dengan_studi')->nullable();
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
        }

        // ── TABLE GALERI ────────────────────────────────────────────
        if (! Schema::hasTable('galeris')) {
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('file_path');
            $table->string('kategori')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
        }

        // ── TABLE PENGUMUMAN ────────────────────────────────────────
        if (! Schema::hasTable('pengumumans')) {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi');
            $table->enum('prioritas', ['tinggi', 'sedang', 'rendah'])->default('sedang');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
        Schema::dropIfExists('galeris');
        Schema::dropIfExists('tracer_studies');
        Schema::dropIfExists('lowongans');
        Schema::dropIfExists('alumni');
    }
};