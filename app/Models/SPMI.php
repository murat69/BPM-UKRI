<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPMI extends Model
{
    use HasFactory;

    protected $table = 'file';
    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }

    public function sub_kategori()
    {
        return $this->hasOne(Sub_kategori::class, 'id', 'sub_kategori_id');
    }

    public function scopeKategori($query, $kategori)
    {
        return $query->whereHas('kategori', function ($query) use ($kategori) {
            $query->where('kategori', $kategori);
        });
    }

    public function scopeSub_kategori($query, $Sub_kategori)
    {
        return $query->whereHas('sub_kategori', function ($query) use ($Sub_kategori) {
            $query->where('sub_kategori', $Sub_kategori);
        });
    }
}
