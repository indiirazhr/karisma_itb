<?php

namespace App\Models;

use App\Models\ProgramFile;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'judul',
        'batas_pendaftar',
        'waktu',
        'tanggal',
        'waktu_berakhir',
        'tanggal_berakhir',
        'lokasi',
        'deskripsi',
        'file_path',
        'category_id'
    ];

    public function files()
    {
        return $this->hasMany(ProgramFile::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

}
