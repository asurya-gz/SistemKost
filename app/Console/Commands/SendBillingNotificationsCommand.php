<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class SendBillingNotificationsCommand extends Command
{
    protected $signature = 'booking:send-billing-notifications';
    protected $description = 'Send billing notifications to tenants whose rental is about to expire';

    public function handle()
    {
        $this->info('Checking for rentals nearing expiration...');
        
        $bookingsNearExpiration = Booking::nearingExpiration(7)->get();
        
        $sentCount = 0;
        
        foreach ($bookingsNearExpiration as $booking) {
            try {
                $booking->sendBillingNotification();
                $sentCount++;
                
                $this->line("Notification sent to {$booking->user->name} for booking {$booking->booking_code}");
                
            } catch (\Exception $e) {
                $this->error("Failed to send notification for booking {$booking->booking_code}: {$e->getMessage()}");
            }
        }
        
        $this->info("Sent {$sentCount} billing notifications");
        
        return Command::SUCCESS;
    }
}
