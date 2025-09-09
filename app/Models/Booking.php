<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kamar_id',
        'booking_code',
        'status',
        'payment_method',
        'total_amount',
        'rental_duration_months',
        'rental_start_date',
        'rental_end_date',
        'billing_notification_sent_at',
        'extension_requested',
        'extension_deadline',
        'booking_expires_at',
        'payment_deadline',
        'notes',
        'transfer_proof',
        'payment_notes',
        'confirmed_at',
        'rejection_reason',
        'rejected_at',
        'rejected_by',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'rental_duration_months' => 'integer',
        'rental_start_date' => 'datetime',
        'rental_end_date' => 'datetime',
        'billing_notification_sent_at' => 'datetime',
        'extension_requested' => 'boolean',
        'extension_deadline' => 'datetime',
        'booking_expires_at' => 'datetime',
        'payment_deadline' => 'datetime',
        'confirmed_at' => 'datetime',
        'rejected_at' => 'datetime',
        'verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'confirmed']);
    }

    public function scopeExpired($query)
    {
        return $query->where('booking_expires_at', '<', Carbon::now())
                    ->where('status', 'pending');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeNearingExpiration($query, $days = 7)
    {
        return $query->where('status', 'confirmed')
                    ->where('rental_end_date', '<=', Carbon::now()->addDays($days))
                    ->where('rental_end_date', '>', Carbon::now())
                    ->whereNull('billing_notification_sent_at');
    }

    public function scopeExpiredRental($query)
    {
        return $query->where('status', 'confirmed')
                    ->where('rental_end_date', '<', Carbon::now())
                    ->where('extension_requested', false);
    }

    // Accessors
    public function getIsExpiredAttribute(): bool
    {
        return $this->booking_expires_at < Carbon::now() && $this->status === 'pending';
    }

    public function getTimeRemainingAttribute(): ?string
    {
        if ($this->status !== 'pending') {
            return null;
        }

        $diff = Carbon::now()->diffInMinutes($this->booking_expires_at, false);
        
        if ($diff <= 0) {
            return 'Expired';
        }

        $hours = floor($diff / 60);
        $minutes = $diff % 60;

        if ($hours > 0) {
            return "{$hours}h {$minutes}m";
        }

        return "{$minutes}m";
    }

    // Methods
    public static function generateBookingCode(): string
    {
        $prefix = 'KH';
        $timestamp = now()->format('ymd');
        $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        return $prefix . $timestamp . $random;
    }

    public function markAsExpired(): void
    {
        $this->update(['status' => 'expired']);
        
        // Make room available again
        $this->kamar->update(['status_kamar' => 'Tersedia']);
    }

    public function confirm(): void
    {
        $this->update([
            'status' => 'confirmed',
            'payment_deadline' => Carbon::now()->addDays(3),
            'rental_start_date' => Carbon::now(),
            'rental_end_date' => Carbon::now()->addMonths($this->rental_duration_months ?? 3)
        ]);
        
        // Keep room as booked
        $this->kamar->update(['status_kamar' => 'Dihuni']);
    }

    public function cancel(): void
    {
        $this->update(['status' => 'cancelled']);
        
        // Make room available again
        $this->kamar->update(['status_kamar' => 'Tersedia']);
    }

    public function sendBillingNotification(): void
    {
        $this->update([
            'billing_notification_sent_at' => Carbon::now(),
            'extension_deadline' => $this->rental_end_date->addDays(7)
        ]);
    }

    public function requestExtension(int $months = 3): void
    {
        $this->update([
            'extension_requested' => true,
            'rental_duration_months' => $months
        ]);
    }

    public function approveExtension(): void
    {
        $newEndDate = $this->rental_end_date->addMonths($this->rental_duration_months);
        
        $this->update([
            'rental_end_date' => $newEndDate,
            'extension_requested' => false,
            'billing_notification_sent_at' => null,
            'extension_deadline' => null
        ]);
    }

    public function expireRental(): void
    {
        $this->update(['status' => 'expired']);
        
        // Make room available again
        $this->kamar->update(['status_kamar' => 'Tersedia']);
    }

    public function getDaysUntilExpirationAttribute(): int
    {
        if (!$this->rental_end_date) {
            return 0;
        }
        
        return Carbon::now()->diffInDays($this->rental_end_date, false);
    }

    public function getIsNearExpirationAttribute(): bool
    {
        return $this->status === 'confirmed' 
            && $this->rental_end_date 
            && $this->rental_end_date->diffInDays(Carbon::now()) <= 7;
    }

    public static function getRentalDurationOptions(): array
    {
        return [
            3 => '3 Bulan',
            6 => '6 Bulan', 
            9 => '9 Bulan',
            12 => '12 Bulan'
        ];
    }
}