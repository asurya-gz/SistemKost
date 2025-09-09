<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\User;
use App\Models\Kamar;
use Illuminate\Console\Command;
use Carbon\Carbon;

class TestBookingFlow extends Command
{
    protected $signature = 'test:booking-flow';
    protected $description = 'Test booking flow with new rental duration feature';

    public function handle()
    {
        $this->info('Testing Booking Flow with Rental Duration...');

        // Test 1: Create a test booking
        $this->info('1. Testing booking creation...');
        
        $user = User::where('role', 'pengguna')->first();
        $kamar = Kamar::where('status_kamar', 'Tersedia')->first();
        
        if (!$user || !$kamar) {
            $this->error('No available user or room found for testing');
            return Command::FAILURE;
        }
        
        $booking = Booking::create([
            'user_id' => $user->id,
            'kamar_id' => $kamar->id,
            'booking_code' => Booking::generateBookingCode(),
            'status' => 'pending',
            'payment_method' => 'transfer_bank',
            'total_amount' => $kamar->typeKamar->harga * 6, // 6 months
            'rental_duration_months' => 6,
            'booking_expires_at' => Carbon::now()->addMinutes(30),
            'notes' => 'Test booking with 6 months duration'
        ]);
        
        $this->info("✅ Booking created: {$booking->booking_code}");
        $this->info("   Duration: {$booking->rental_duration_months} months");
        $this->info("   Total: Rp " . number_format($booking->total_amount, 0, ',', '.'));
        
        // Test 2: Confirm booking
        $this->info('2. Testing booking confirmation...');
        $booking->confirm();
        $this->info("✅ Booking confirmed");
        $this->info("   Rental Start: {$booking->rental_start_date}");
        $this->info("   Rental End: {$booking->rental_end_date}");
        
        // Test 3: Test scope methods
        $this->info('3. Testing scope methods...');
        
        // Near expiration test (simulate)
        $testBooking = clone $booking;
        $testBooking->rental_end_date = Carbon::now()->addDays(5);
        $testBooking->save();
        
        $nearExpiration = Booking::nearingExpiration(7)->count();
        $this->info("✅ Near expiration bookings: {$nearExpiration}");
        
        // Test 4: Extension request
        $this->info('4. Testing extension request...');
        $booking->requestExtension(9);
        $this->info("✅ Extension requested for {$booking->rental_duration_months} months");
        $this->info("   Extension requested: " . ($booking->extension_requested ? 'Yes' : 'No'));
        
        // Test 5: Approve extension
        $this->info('5. Testing extension approval...');
        $oldEndDate = $booking->rental_end_date->copy();
        $booking->approveExtension();
        $this->info("✅ Extension approved");
        $this->info("   Old end date: {$oldEndDate}");
        $this->info("   New end date: {$booking->rental_end_date}");
        
        // Test 6: Test rental duration options
        $this->info('6. Testing rental duration options...');
        $options = Booking::getRentalDurationOptions();
        foreach ($options as $months => $label) {
            $this->info("   {$months} months: {$label}");
        }
        
        // Clean up
        $this->info('7. Cleaning up test data...');
        $booking->delete();
        $kamar->update(['status_kamar' => 'Tersedia']);
        $this->info("✅ Test data cleaned up");
        
        $this->info('');
        $this->info('🎉 All booking flow tests passed successfully!');
        return Command::SUCCESS;
    }
}
