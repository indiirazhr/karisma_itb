<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['nama'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
