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
        Schema::create('type_kamar_fasilitas_kost', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_kamar_id')->constrained('type_kamar')->onDelete('cascade');
            $table->foreignId('fasilitas_kost_id')->constrained('fasilitas_kost')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['type_kamar_id', 'fasilitas_kost_id'], 'tk_fkost_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_kamar_fasilitas_kost');
    }
};
