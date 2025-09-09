<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class ExpireRentalBookingsCommand extends Command
{
    protected $signature = 'booking:expire-rentals';
    protected $description = 'Expire rental bookings that have passed their end date without extension';

    public function handle()
    {
        $this->info('Checking for expired rentals...');
        
        $expiredRentals = Booking::expiredRental()->get();
        
        $expiredCount = 0;
        
        foreach ($expiredRentals as $booking) {
            try {
                $booking->expireRental();
                $expiredCount++;
                
                $this->line("Expired rental for {$booking->user->name} - booking {$booking->booking_code}");
                $this->line("Room {$booking->kamar->nama_kamar} is now available");
                
            } catch (\Exception $e) {
                $this->error("Failed to expire rental for booking {$booking->booking_code}: {$e->getMessage()}");
            }
        }
        
        $this->info("Expired {$expiredCount} rentals");
        
        return Command::SUCCESS;
    }
}
