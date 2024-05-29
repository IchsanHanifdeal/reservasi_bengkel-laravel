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
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->id('id_perbaikan');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->string('nama_mobil');
            $table->string('plat_mobil');
            $table->string('no_whatsapp');
            $table->string('tentang_kerusakan');
            $table->unsignedBigInteger('id_mekanik')->nullable();
            $table->foreign('id_mekanik')->references('id_mekanik')->on('mekanik')->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->enum('status', ['sudah diproses', 'belum diproses', 'sudah selesai'])->default('belum diproses');
            $table->date('tanggal_selesai')->nullable();
            $table->bigInteger('harga_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikan');
    }
};
