<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama',
    'spesialisasi',
    'no_telepon',
    'hari_praktik',
    ];
    
    protected function casts(): array
    {
        return [
            'hari_praktik' => 'array',
        ];
    }

    public function jadwalPemeriksaans()
    {
        return $this->hasMany(JadwalPemeriksaan::class);
    }

    public function antrians()
    {
        return $this->hasMany(Antrian::class);
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }
}
