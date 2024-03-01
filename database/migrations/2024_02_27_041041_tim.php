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
        Schema::create('tim', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tim');
            $table->string('asal_institusi');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('manager');
            $table->string('no_hp');
            $table->string('foto_tim');
            $table->string('surat_tugas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim');
    }
};
