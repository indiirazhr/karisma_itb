<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumentasiFile extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi_files';

    protected $fillable = [
        'dokumentasi_id',
        'file_path',
    ];

    public function dokumentasi()
    {
        return $this->belongsTo(Dokumentasi::class);
    }
}