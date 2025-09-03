<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KebijakanKamar extends Model
{
    protected $table = 'kebijakan_kamar';
    
    protected $fillable = [
        'deskripsi'
    ];
}
