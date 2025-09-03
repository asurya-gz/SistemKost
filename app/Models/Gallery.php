<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'manage_gambar';
    
    protected $fillable = [
        'type',
        'judul',
        'path',
        'alt_text',
        'deskripsi',
        'urutan',
        'is_published'
    ];
    
    protected $casts = [
        'is_published' => 'boolean',
        'urutan' => 'integer'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('galeri', function ($builder) {
            $builder->where('type', 'galeri');
        });
    }
    
    public function getUrlAttribute()
    {
        // Jika path berupa URL eksternal (http/https), gunakan langsung
        if (str_starts_with($this->path, 'http')) {
            return $this->path;
        }
        
        // Jika file lokal, gunakan asset storage
        return asset('storage/' . $this->path);
    }
}
