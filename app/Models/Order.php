<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $fillable = ['user_id', 'product_id', 'jumlah', 'total_harga', 'status' , 'nama_pemesan', 'email_pemesan', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
