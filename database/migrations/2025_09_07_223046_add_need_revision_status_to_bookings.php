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
        // Update the enum to include 'need_revision'
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending', 'confirmed', 'verified', 'need_revision', 'cancelled', 'expired') DEFAULT 'pending'");
        
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('rejection_reason')->nullable()->after('payment_notes');
            $table->timestamp('rejected_at')->nullable()->after('rejection_reason');
            $table->unsignedBigInteger('rejected_by')->nullable()->after('rejected_at');
            $table->timestamp('verified_at')->nullable()->after('confirmed_at');
            $table->unsignedBigInteger('verified_by')->nullable()->after('verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending', 'confirmed', 'cancelled', 'expired') DEFAULT 'pending'");
        
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['rejection_reason', 'rejected_at', 'rejected_by', 'verified_at', 'verified_by']);
        });
    }
};
