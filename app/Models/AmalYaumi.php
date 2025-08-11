<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmalYaumi extends Model
{
    use HasFactory;

      protected $table = 'amal_yaumi'; 

    protected $fillable = [
        'user_id',
        'sholat_5_waktu',
        'sholat_dhuha',
        'qiyamul_lail',
        'puasa_sunnah',
        'tilawah',
        'membaca_buku',
        'membantu_orang_tua',
        'mengerjakan_tugas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

