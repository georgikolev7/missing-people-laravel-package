<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonPhotoTable extends Migration
{
    public function up()
    {
        Schema::create('person_photo', function (Blueprint $table) {
            $table->bigIncrements('photo_id');
            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 255);
            $table->integer('size')->unsigned();
            $table->string('type', 55);
            $table->string('file', 255);
            $table->string('thumb', 255);
            $table->string('icon', 255);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('person_photo');
    }
}
