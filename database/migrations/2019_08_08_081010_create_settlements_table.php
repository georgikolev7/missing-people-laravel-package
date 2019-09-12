<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB;

class CreateSettlementsTable extends Migration
{
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('place_id')->unsigned();
            $table->bigInteger('region_id')->unsigned();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('code', 50);
            $table->integer('ekatte')->unsigned();
            $table->string('name', 255);
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
            $table->integer('people')->unsigned();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
        
        DB::statement('ALTER TABLE settlements CHANGE ekatte ekatte INT(5) UNSIGNED ZEROFILL NOT NULL');
    }
    
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}
