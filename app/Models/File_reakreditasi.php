<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_reakreditasi extends Model
{
    use HasFactory;
    protected $table = 'file_reakreditasi';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'id', 'jurusan_id');
    }
}
