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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('is_profile_completed');
            $table->string('nik', 16)->nullable()->after('full_name');
            $table->text('address')->nullable()->after('nik');
            $table->enum('gender', ['L', 'P'])->nullable()->after('address');
            $table->string('ktp_file')->nullable()->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'nik', 'address', 'gender', 'ktp_file']);
        });
    }
};
