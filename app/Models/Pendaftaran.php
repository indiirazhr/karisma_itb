<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'program_id',
        'alasan',
        'status',
    ];

    /**
     * Relasi ke user yang mendaftar
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke program yang didaftarkan
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function presensi()
    {
        return $this->hasOne(Presensi::class);
    }
}
