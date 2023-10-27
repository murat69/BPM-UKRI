<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_kategori extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori';

    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }
}
