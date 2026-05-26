<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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

    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
