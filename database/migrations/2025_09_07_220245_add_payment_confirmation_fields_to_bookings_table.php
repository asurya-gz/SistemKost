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
            $table->string('transfer_proof')->nullable()->after('notes');
            $table->text('payment_notes')->nullable()->after('transfer_proof');
            $table->timestamp('confirmed_at')->nullable()->after('payment_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['transfer_proof', 'payment_notes', 'confirmed_at']);
        });
    }
};
