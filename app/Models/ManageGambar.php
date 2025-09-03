<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageGambar extends Model
{
    protected $table = 'manage_gambar';
    
    protected $fillable = [
        'type',
        'type_kamar_id',
        'nama_file',
        'judul',
        'path',
        'alt_text',
        'deskripsi',
        'urutan',
        'is_primary',
        'is_published'
    ];
    
    protected $casts = [
        'is_primary' => 'boolean',
        'is_published' => 'boolean',
        'urutan' => 'integer'
    ];
    
    public function typeKamar()
    {
        return $this->belongsTo(TypeKamar::class);
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
