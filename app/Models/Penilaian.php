<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Penilaian extends Model
{
    use HasFactory, HasUuids;
    
    protected $table = 'penilaian';
    
    protected $fillable = [
        'name',
        'tingkatan',
        'nilai_salam',
        'nilai_pukulan',
        'nilai_tangkisan',
        'nilai_tendangan',
        'nilai_teknik_pn',
        'nilai_fisik',
        'nilai_serang_balas',
        'nilai_jurus',
        'rata_rata',
        'detail_nilai',
        'petugas',
        'tanggal',
    ];
    
    protected $casts = [
        'detail_nilai' => 'array',
        'tanggal' => 'datetime',
        'rata_rata' => 'decimal:2',
    ];
}
