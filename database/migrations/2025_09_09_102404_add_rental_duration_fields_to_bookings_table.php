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
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('rental_duration_months')->default(3)->after('total_amount');
            $table->timestamp('rental_start_date')->nullable()->after('rental_duration_months');
            $table->timestamp('rental_end_date')->nullable()->after('rental_start_date');
            $table->timestamp('billing_notification_sent_at')->nullable()->after('rental_end_date');
            $table->boolean('extension_requested')->default(false)->after('billing_notification_sent_at');
            $table->timestamp('extension_deadline')->nullable()->after('extension_requested');
            
            $table->index('rental_end_date');
            $table->index('extension_deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex(['rental_end_date']);
            $table->dropIndex(['extension_deadline']);
            $table->dropColumn([
                'rental_duration_months',
                'rental_start_date', 
                'rental_end_date',
                'billing_notification_sent_at',
                'extension_requested',
                'extension_deadline'
            ]);
        });
    }
};
