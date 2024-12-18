<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarFavorit extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi
    protected $table = 'daftar_favorit';

    // Tentukan kolom yang dapat diisi
    protected $fillable = ['id_shop', 'user_id'];

    // Relasi dengan model CoffeeShop
    public function coffeeShop()
    {
        return $this->belongsTo(CoffeeShop::class, 'id_shop', 'id_shop');
    }

    // Relasi dengan model User (jika perlu)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
