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
            $table->date('last_seen');
            $table->unique('hash');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
