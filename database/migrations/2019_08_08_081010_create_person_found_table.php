<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonFoundTable extends Migration
{
    public function up()
    {
        Schema::create('person_found', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date_found');
            $table->tinyInteger('dead');
            $table->engine = 'InnoDB';
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('person_found');
    }
}
