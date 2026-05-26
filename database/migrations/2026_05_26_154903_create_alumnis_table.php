<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('program_studi');
            $table->string('angkatan')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->decimal('ipk', 3, 2)->nullable();
            $table->string('status_kerja')->nullable();
            $table->string('perusahaan')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
