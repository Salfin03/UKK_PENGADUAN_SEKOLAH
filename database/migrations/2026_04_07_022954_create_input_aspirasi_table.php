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
        Schema::create('input_aspirasi', function (Blueprint $table) {
            $table->integer('Id_pelaporan')->primary();
            $table->integer('nis');
            $table->foreign('nis')->references('nis')->on('siswa')->onDelete('cascade');
            $table->integer('id_kategori');
            $table->foreign('id_kategori')->references('Id_kategori')->on('kategori')->onDelete('cascade');
            $table->string('lokasi', 50);
            $table->string('ket', 50);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_aspirasi');
    }
};
