<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoffeeShopTable extends Migration
{
    public function up()
    {
        Schema::create('coffee_shop', function (Blueprint $table) {
            $table->id('id_shop');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('shop_name')->unique();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->text('address');
            $table->string('category');
            $table->time('opening_hour');
            $table->time('closing_hour');
            $table->string('open_days');
            $table->text('description')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('google_maps_link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coffee_shop');
    }
}
