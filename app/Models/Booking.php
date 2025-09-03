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
        'booking_expires_at',
        'payment_deadline',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'booking_expires_at' => 'datetime',
        'payment_deadline' => 'datetime',
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
            'payment_deadline' => Carbon::now()->addDays(3)
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
}