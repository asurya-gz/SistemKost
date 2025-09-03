<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpireBookingsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire bookings that have exceeded their time limit';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting booking expiration check...');
        
        $expiredBookings = Booking::expired()->get();
        $expiredCount = 0;
        
        foreach ($expiredBookings as $booking) {
            DB::beginTransaction();
            try {
                $this->info("Expiring booking: {$booking->booking_code} (Room: {$booking->kamar->nama_kamar})");
                
                $booking->markAsExpired();
                $expiredCount++;
                
                DB::commit();
                $this->info("✓ Booking {$booking->booking_code} expired successfully");
            } catch (\Exception $e) {
                DB::rollback();
                $this->error("✗ Failed to expire booking {$booking->booking_code}: " . $e->getMessage());
            }
        }
        
        if ($expiredCount > 0) {
            $this->info("Successfully expired {$expiredCount} bookings.");
        } else {
            $this->info('No expired bookings found.');
        }
        
        return 0;
    }
}
