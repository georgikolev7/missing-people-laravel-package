<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('place_id')->unsigned();
            $table->string('code', 50);
            $table->integer('ekatte')->unsigned();
            $table->string('name', 255);
            $table->decimal('lat', 10, 8);
            $table->decimal('lng', 11, 8);
            $table->integer('people')->unsigned();
            $table->integer('settlements')->unsigned();
            $table->enum('type', ['area', 'city']);
            $table->integer('sort_order')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
