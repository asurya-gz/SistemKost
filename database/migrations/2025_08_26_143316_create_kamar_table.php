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
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar');
            $table->foreignId('type_kamar_id')->constrained('type_kamar')->onDelete('cascade');
            $table->enum('status_kamar', ['Tersedia', 'Booked', 'Dihuni'])->default('Tersedia');
            $table->json('kebijakan_kamar_ids')->nullable(); // Array of kebijakan IDs
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
