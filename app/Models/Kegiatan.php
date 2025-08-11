<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kegiatan extends Model
{
    //protected $table = 'kegiatan';
    protected $guarded = ['id'];

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

