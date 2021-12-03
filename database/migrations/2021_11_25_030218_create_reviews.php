<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('ID');
            $table->tinyInteger('ID_city');
            $table->tinyInteger('ID_place');
            $table->tinyInteger('ID_user');
            $table->tinyInteger('rate');
            $table->string('picture')->nullable();
            $table->longText('content');
            $table->tinyInteger('status')->comment('0-deleted;1-publish;2-unpublish')->default(0);
            $table->tinyInteger('views')->default(0);
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
        Schema::dropIfExists('reviews');
    }
}
