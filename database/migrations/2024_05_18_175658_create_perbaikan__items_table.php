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
        Schema::create('perbaikan_item', function (Blueprint $table) {
            $table->id('id_perbaikanitem');
            $table->unsignedBigInteger('id_perbaikan');
            $table->foreign('id_perbaikan')->references('id_perbaikan')->on('perbaikan')->onDelete('cascade');
            $table->unsignedBigInteger('id_item');
            $table->foreign('id_item')->references('id_item')->on('item')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikan_item');
    }
};
