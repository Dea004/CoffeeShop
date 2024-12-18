<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoffeeShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coffee_shops')->truncate();
        DB::table('coffee_shops')->insert([
            [
                'slug' => 'rutukopi',
                'name' => 'Rutu Kopi Denpasar',
                'description' => 'Rumah Kami Siap Menyambut Kalian',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 09:00 - 23:00 WITA',
                'image' => 'img/RutuKopi/rutukopi1.jpg',
            ],
            [
                'slug' => 'jayagiri',
                'name' => 'Jayagiri Coffee',
                'description' => 'Menyajikan Kualitas, Menyentuh Hati',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 09:00 - 21:00 WITA',
                'image' => 'img/Jayagiri/jayagiri1.jpg',
            ],
            [
                'slug' => 'alascoffe',
                'name' => 'Alas Coffee and Space',
                'description' => 'Nugas, Ngumpul, Mabar, Nongkrong',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 17:00 - 05:00 WITA',
                'image' => 'img/AlasCoffee/AlasCoffee7.jpg',
            ],
            [
                'slug' => 'kajabali',
                'name' => 'Kaja Bali',
                'description' => 'Penuhi Hari Anda dengan Kekuatan Kopi',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Senin - Sabtu: 09:00 - 23:00 WITA',
                'image' => 'img/Kaja/kaja6.jpg',
            ],
            [
                'slug' => 'etucoffee',
                'name' => 'Etu Coffee',
                'description' => 'Seduh Kisah, Nikmati Kelezatan',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 07:30 - 22:00 WITA',
                'image' => 'img/Etu/Etu11.jpg',
            ],
            [
                'slug' => 'sekopirenon',
                'name' => 'Sekopi Renon',
                'description' => 'Kedai Kopi Sekolah',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 11:00 - 01:00 WITA',
                'image' => 'img/Sekopi/sekopi1.jpg',
            ],
            [
                'slug' => 'selesacoffee',
                'name' => 'Selesa Coffee & Eatery',
                'description' => 'Lunch, Dinner, Event',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Minggu - Kamis: 11:00 - 23:00 WITA, Jumat - Sabtu: 11.00 - 00.00 WITA',
                'image' => 'img/Selesa/selesa2.jpg',
            ],
            [
                'slug' => 'tujuhduacoffee',
                'name' => 'Tujuh Dua Coffee',
                'description' => 'Coffee in Denpasar',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Senin - Sabtu: 11:00 - 00:00 WITA, Minggu: 16.00 - 00.00 WITA',
                'image' => 'img/TujuhDua/tujuh1.jpg',
            ],
            [
                'slug' => 'ateracoffee',
                'name' => 'Atera Coffee',
                'description' => 'Kopi yang Menginspirasi, Setiap Saat',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 00:00 - 00:00 WITA',
                'image' => 'img/Atera/atera6.jpg',
            ],
            [
                'slug' => 'sakarakopi',
                'name' => 'Sakara Kopi Bali',
                'description' => 'Nikmati Kopi Bersama Kesayangan',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 08:00 - 23:00 WITA',
                'image' => 'img/Sakara/sakara4.jpg',
            ],
            [
                'slug' => 'saicoffee',
                'name' => 'SAI Coffee & Creative Space',
                'description' => 'Tempatmu tertawa melepas penat, Dimana Semua Cerita Berawal Dari Secangkir Kopi',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 08:00 - 23:00 WITA',
                'image' => 'img/Sai/sai8.jpg',
            ],
            [
                'slug' => 'gooryCoffee',
                'name' => 'Goory Coffee & Eatery',
                'description' => 'Tempat Baru Bertemu Kehangatan',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Jumat: 09.00 - 23:00 WITA, Minggu: 09.00 - 00:00 WITA',
                'image' => 'img/Goory/goory1.jpg',
            ],
            [
                'slug' => 'pistoCoffee',
                'name' => 'Pisto Coffee & Eatery',
                'description' => 'Working - Hangout - Meeting - Creative',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 09:00 - 00:00 WITA',
                'image' => 'img/Pisto/pisto6.jpg',
            ],
            [
                'slug' => 'rumaRasa',
                'name' => 'RUmaRasa Bali',
                'description' => 'Taste Like Home, Feels Like Home',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Senin - Jumat: 08:30 - 22:30 WITA, Sabtu - Minggu: 12.00 - 21:00 WITA',
                'image' => 'img/RumaRasa/ruma1.jpg',
            ],
            [
                'slug' => 'tahomacoffee',
                'name' => 'Tahoma Kopi',
                'description' => 'Dari Alam, Untuk Kopi yang Sempurna',
                'details' => 'Alamat, menu, review, dll.',
                'opening_hours' => 'Setiap Hari: 00:00 - 00:00 WITA',
                'img/Tahoma/tahoma3.jpg',
            ],

        ]);
    }
}
