<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarFavoritTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_favorit', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_shop'); // Foreign key to coffee_shops table
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->timestamps(); // Created_at and updated_at timestamps

            // Define foreign key constraint for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Define foreign key constraint for id_shop
            $table->foreign('id_shop')->references('id_shop')->on('coffee_shop')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_favorit');
    }
}
