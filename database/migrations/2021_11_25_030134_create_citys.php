<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citys', function (Blueprint $table) {
            $table->id('ID');
            $table->string('name');
            $table->bigInteger('population')->nullable();
            $table->bigInteger('area')->nullable()->comment('(m2');
            $table->longText('content')->nullable();
            $table->string('picture')->nullable();
            $table->boolean('status')->default(1)->comment('0-deleted;1-active');
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
        Schema::dropIfExists('citys');
    }
}
