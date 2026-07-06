<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pemeriksaans';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal',
        'waktu',
        'keluhan',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
