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
        Schema::create('gambar_type_kamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_kamar_id')->constrained('type_kamar')->onDelete('cascade');
            $table->string('nama_file');
            $table->string('path');
            $table->string('alt_text')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_type_kamar');
    }
};
