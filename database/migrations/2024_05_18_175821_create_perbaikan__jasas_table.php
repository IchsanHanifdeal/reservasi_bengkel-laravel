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
        Schema::create('perbaikan_jasa', function (Blueprint $table) {
            $table->id('id_perbaikanjasa');
            $table->unsignedBigInteger('id_perbaikan');
            $table->foreign('id_perbaikan')->references('id_perbaikan')->on('perbaikan')->onDelete('cascade');
            $table->unsignedBigInteger('id_jasa');
            $table->foreign('id_jasa')->references('id_jasa')->on('jasa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikan_jasa');
    }
};
