<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
    use HasFactory;

    protected $table = 'akreditasi';

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'id', 'jurusan_id');
    }
}
