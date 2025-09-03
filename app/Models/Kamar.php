<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    protected $table = 'kamar';
    
    protected $fillable = [
        'nama_kamar',
        'type_kamar_id',
        'status_kamar',
        'kebijakan_kamar_ids'
    ];

    protected $casts = [
        'kebijakan_kamar_ids' => 'array'
    ];

    public function typeKamar(): BelongsTo
    {
        return $this->belongsTo(TypeKamar::class, 'type_kamar_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getKebijakanKamar()
    {
        if (!$this->kebijakan_kamar_ids) {
            return collect();
        }
        
        return KebijakanKamar::whereIn('id', $this->kebijakan_kamar_ids)->get();
    }
}
