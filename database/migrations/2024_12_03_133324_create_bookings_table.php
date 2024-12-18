<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); 
            $table->string('coffee_shop_name'); 
            $table->string('name'); 
            $table->string('contact'); 
            $table->time('start_time'); 
            $table->time('end_time'); 
            $table->date('date'); 
            $table->integer('people'); 
            $table->enum('booking_type', ['tempat', 'ruangan']); 
            $table->enum('status', ['pending', 'cancel', 'accept'])->default('pending'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
