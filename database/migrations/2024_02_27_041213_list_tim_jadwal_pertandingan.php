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
        Schema::create('list_tim_jadwal_pertandingan', function (Blueprint $table) {
            $table->id();
            $table->string('id_pertandingan');
            $table->string('id_tim');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_tim_jadwal_pertandingan');
    }
};
