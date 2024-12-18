<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeShop extends Model
{
    use HasFactory;

    protected $table = 'coffee_shop';

    protected $primaryKey = 'id_shop'; // Tentukan primary key yang benar

    protected $fillable = [
        'id_user',
        'shop_name',
        'email',
        'phone_number',
        'address',
        'category',
        'opening_hour',
        'closing_hour',
        'open_days',
        'description',
        'profile_picture',
        'google_maps_link',
    ];

    // Relasi dengan model DaftarFavorit
    public function daftarFavorits()
    {
        return $this->hasMany(DaftarFavorit::class, 'id_shop', 'id_shop');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
