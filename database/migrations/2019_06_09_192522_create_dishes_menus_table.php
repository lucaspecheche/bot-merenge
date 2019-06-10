<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishesMenusTable extends Migration
{
    public function up()
    {
        Schema::create('dishes_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dishId')->unsigned();
            $table->integer('menuId')->unsigned();
            $table->timestamps();

            $table->foreign('dishId')->references('id')->on('dishes')->onDelete('cascade');
            $table->foreign('menuId')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dishes_menus');
    }
}
