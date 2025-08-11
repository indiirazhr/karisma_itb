<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'user_id',
        'nominal',
        'bukti_transfer',
        'status',
    ];

 public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
