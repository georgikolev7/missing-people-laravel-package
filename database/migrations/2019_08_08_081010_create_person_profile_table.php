<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonProfileTable extends Migration
{
    public function up()
    {
        Schema::create('person_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('age')->unsigned();
            $table->integer('height')->unsigned();
            $table->year('year_of_birth');
            $table->enum('sex', ['male', 'female']);
            
            $table->integer('eyes_color')->unsigned();
            $table->foreign('eyes_color')->references('id')->on('eyes_color');
            
            $table->integer('hair_color')->unsigned();
            $table->foreign('hair_color')->references('id')->on('hair_color');
            
            $table->text('description');
            $table->bigInteger('region_id')->unsigned();
            $table->bigInteger('settlement_id')->unsigned();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('person_profile');
    }
}
