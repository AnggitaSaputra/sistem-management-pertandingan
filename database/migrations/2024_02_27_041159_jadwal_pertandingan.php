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
        Schema::create('jadwal_pertandingan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pertandingan');
            $table->string('waktu_mulai_pertandingan');
            $table->string('waktu_akhir_pertandingan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pertandingan');
    }
};
