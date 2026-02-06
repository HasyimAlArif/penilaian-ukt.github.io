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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->enum('tingkatan', ['Putih', 'Kuning', 'Merah', 'Biru', 'Coklat', 'Hitam']);
            
            // Nilai Kategori
            $table->decimal('nilai_salam', 5, 2)->default(0);
            $table->decimal('nilai_pukulan', 5, 2)->default(0);
            $table->decimal('nilai_tangkisan', 5, 2)->default(0);
            $table->decimal('nilai_tendangan', 5, 2)->default(0);
            $table->decimal('nilai_teknik_pn', 5, 2)->default(0);
            $table->decimal('nilai_fisik', 5, 2)->default(0);
            $table->decimal('nilai_serang_balas', 5, 2)->default(0);
            $table->decimal('nilai_jurus', 5, 2)->default(0);
            
            $table->decimal('rata_rata', 5, 2)->default(0);
            $table->json('detail_nilai')->nullable();
            $table->string('petugas');
            $table->dateTime('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
