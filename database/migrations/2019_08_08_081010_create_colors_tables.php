<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsTables extends Migration
{
    public function up()
    {
        Schema::create('eyes_color', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 55);
            $table->engine = 'InnoDB';
        });
        
        Schema::create('hair_color', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 55);
            $table->engine = 'InnoDB';
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('eyes_color');
        Schema::dropIfExists('hair_color');
    }
}
