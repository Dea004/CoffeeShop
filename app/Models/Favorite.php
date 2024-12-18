<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'coffee_shop_name', 'address', 'user_id', 'saved_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Relasi ke User
    }

    protected $table = 'daftar_favorit';
}