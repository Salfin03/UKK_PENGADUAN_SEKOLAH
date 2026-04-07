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
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->integer('id_aspirasi')->primary();
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai']);
            $table->integer('id_pelaporan');
            $table->foreign('id_pelaporan')->references('Id_pelaporan')->on('input_aspirasi')->onDelete('cascade');
            $table->string('feedback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
