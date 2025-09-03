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
        Schema::table('type_kamar', function (Blueprint $table) {
            $table->integer('harga')->after('type_kasur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_kamar', function (Blueprint $table) {
            $table->dropColumn('harga');
        });
    }
};
