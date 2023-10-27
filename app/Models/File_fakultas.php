<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_fakultas extends Model
{
    use HasFactory;

    protected $table = 'file_fakultas';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function fakultas()
    {
        return $this->hasOne(Fakultas::class, 'id', 'fakultas_id');
    }
}
