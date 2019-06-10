<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->unsigned();
            $table->integer('dishId')->unsigned();

            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dishId')->references('id')->on('dishes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
