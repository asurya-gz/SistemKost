<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FasilitasKost extends Model
{
    protected $table = 'fasilitas_kost';
    
    protected $fillable = [
        'nama',
        'icon',
        'deskripsi',
        'is_active',
        'urutan'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer'
    ];
    
    public function typeKamars()
    {
        return $this->belongsToMany(TypeKamar::class, 'type_kamar_fasilitas_kost');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }
}
