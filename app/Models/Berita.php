<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    public function img_berita()
    {
        return $this->hasMany(img_berita::class, 'berita_id', 'id');
    }
}
