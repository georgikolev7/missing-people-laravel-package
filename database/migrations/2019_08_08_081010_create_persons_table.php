<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash', 55);
            $table->enum('type', ['missing_person', 'wanted_criminal']);
            $table->string('name', 255);
            $table->integer('age')->unsigned();
            $table->year('year_of_birth');
            $table->enum('sex', ['male', 'female']);
            $table->integer('height')->unsigned();
            $table->date('last_seen');
            $table->integer('eyes_color')->unsigned();
            $table->integer('hair_color')->unsigned();
            $table->text('description');
            $table->integer('region_id')->unsigned();
            $table->integer('settlement_id')->unsigned();
            $table->tinyInteger('found');
            $table->dateTime('date_added');
            $table->date('date_found');
            $table->unique('hash');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
