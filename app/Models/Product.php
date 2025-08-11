<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'no_rekening', 'divisi_id', 'photo',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

     public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
