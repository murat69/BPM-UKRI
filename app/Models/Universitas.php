<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universitas extends Model
{
    use HasFactory;
    protected $table = 'file_universitas';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}