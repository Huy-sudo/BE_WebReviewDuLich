<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id('ID');
            $table->string('name');
            $table->tinyInteger('ID_city');
            $table->longText('content')->nullable();
            $table->string('address')->nullable();
            $table->string('picture')->nullable();
            $table->unsignedInteger('totalReview')->nullable();
            $table->tinyInteger('isReal')->comment('0-unreal;1-real;2-delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
