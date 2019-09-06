<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTables extends Migration
{
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('person_id');
            $table->string('ip_address');
            $table->text('user_agent');
            $table->timestamps();
            // foreign
            $table->foreign('person_id')->references('id')->on('persons');
            
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
