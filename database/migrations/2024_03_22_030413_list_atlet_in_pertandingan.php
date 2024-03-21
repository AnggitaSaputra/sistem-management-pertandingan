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
        Schema::create('list_atlet_in_pertandingan', function (Blueprint $table) {
            $table->id();
            $table->string('id_jadwal_pertandingan');
            $table->string('id_atlet');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_atlet_in_pertandingan');
    }
};
