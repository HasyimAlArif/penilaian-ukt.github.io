<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soal extends Model
{
    use HasFactory;
    
    protected $table = 'soal';
    
    protected $fillable = [
        'tingkatan',
        'kategori',
        'soal',
    ];
}
