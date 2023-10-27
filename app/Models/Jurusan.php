<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';

    public function fakultas()
    {
        return $this->hasOne(Fakultas::class, 'id', 'fakultas_id');
    }
}
