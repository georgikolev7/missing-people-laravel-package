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
            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('age')->unsigned();
            $table->integer('height')->unsigned();
            $table->year('year_of_birth');
            $table->enum('sex', ['male', 'female']);
            $table->integer('eyes_color')->unsigned();
            $table->integer('hair_color')->unsigned();
            $table->text('description');
            $table->integer('region_id')->unsigned();
            $table->integer('settlement_id')->unsigned();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('person_profile');
    }
}
