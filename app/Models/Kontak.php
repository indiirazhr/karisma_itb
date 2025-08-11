<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
   protected $fillable = ['name', 'email', 'phone', 'subject', 'message'];

}
