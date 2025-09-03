<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeKamar extends Model
{
    protected $table = 'type_kamar';
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'ukuran_kamar',
        'type_kasur',
        'harga',
        'gambar',
        'fasilitas_kost',
        'fasilitas_kamar'
    ];
    
    protected $casts = [
        'gambar' => 'array',
        'fasilitas_kost' => 'array',
        'fasilitas_kamar' => 'array'
    ];
    
    // New relationships
    public function gambarTypeKamar()
    {
        return $this->hasMany(ManageGambar::class)->where('type', 'type_kamar')->orderBy('urutan');
    }
    
    public function gambarPrimary()
    {
        return $this->hasOne(ManageGambar::class)->where('type', 'type_kamar')->where('is_primary', true);
    }
    
    public function fasilitasKostRel()
    {
        return $this->belongsToMany(FasilitasKost::class, 'type_kamar_fasilitas_kost')->where('is_active', true)->orderBy('urutan');
    }
    
    public function fasilitasKamarRel()
    {
        return $this->belongsToMany(FasilitasKamar::class, 'type_kamar_fasilitas_kamar')->where('is_active', true)->orderBy('urutan');
    }
}
