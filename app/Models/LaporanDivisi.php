<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanDivisi extends Model
{
    use HasFactory;

    protected $table = 'laporan_divisis';

    protected $fillable = [
        'divisi_id',
        'user_id',
        'bulan',
        'jumlah_adik',
        'pemasukan',
        'pengeluaran',
        'keterangan',
    ];

    protected $casts = [
        'bulan' => 'date',
        'pemasukan' => 'decimal:2',
        'pengeluaran' => 'decimal:2',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
