<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramFile extends Model
{
    protected $fillable = ['program_id', 'file_path'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

