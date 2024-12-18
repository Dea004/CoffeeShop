<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('coffee_shop', function (Blueprint $table) {
            $table->text('google_maps_link')->change();
        });
    }

    public function down()
    {
        Schema::table('coffee_shop', function (Blueprint $table) {
            $table->string('google_maps_link', 255)->change();
        });
    }
};
