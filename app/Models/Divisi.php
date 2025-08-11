<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $fillable = ['nama'];

    /**
     * Get the laporan divisi associated with the divisi.
     */
    public function laporanDivisi()
    {
        return $this->hasMany(LaporanDivisi::class);
    }
}
