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
        // Table already renamed, just update structure for universal usage
        Schema::table('manage_gambar', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('manage_gambar', 'type')) {
                // Add type column to differentiate between type_kamar and galeri
                $table->enum('type', ['type_kamar', 'galeri'])->default('type_kamar')->after('id');
            }
            
            // Make type_kamar_id nullable since galeri won't have it
            $table->dropForeign('gambar_type_kamar_type_kamar_id_foreign');
            $table->unsignedBigInteger('type_kamar_id')->nullable()->change();
            $table->foreign('type_kamar_id')->references('id')->on('type_kamar')->onDelete('cascade');
            
            // Add galeri-specific fields if they don't exist
            if (!Schema::hasColumn('manage_gambar', 'judul')) {
                $table->string('judul')->nullable()->after('nama_file');
            }
            if (!Schema::hasColumn('manage_gambar', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('alt_text');
            }
            if (!Schema::hasColumn('manage_gambar', 'is_published')) {
                $table->boolean('is_published')->default(true)->after('is_primary');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manage_gambar', function (Blueprint $table) {
            $table->dropColumn(['type', 'judul', 'deskripsi', 'is_published']);
            $table->dropForeign('gambar_type_kamar_type_kamar_id_foreign');
            $table->unsignedBigInteger('type_kamar_id')->nullable(false)->change();
            $table->foreign('type_kamar_id')->references('id')->on('type_kamar')->onDelete('cascade');
        });
        
        Schema::rename('manage_gambar', 'gambar_type_kamar');
    }
};
