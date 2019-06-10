<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesTable extends Migration
{
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('label')->nullable();
            $table->string('type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}
