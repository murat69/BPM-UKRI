<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File_prodi extends Model
{
    use HasFactory;

    protected $table = 'file_prodi';



    public function scopeJurusan_id($query, $jurusan)
    {
        return $query->where('jurusan_id', $jurusan);
    }

    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'id', 'jurusan_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
