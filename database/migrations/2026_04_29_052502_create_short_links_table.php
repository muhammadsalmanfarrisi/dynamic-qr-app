<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('short_links', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();

            // short_code digunakan sebagai identifier di URL (index unik agar pencarian cepat)
            $table->string('short_code')->unique();

            // Menggunakan text karena URL tujuan bisa sangat panjang
            $table->text('destination_url');

            // Statistik sederhana untuk memantau penggunaan
            $table->unsignedBigInteger('clicks')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_links');
    }
};
