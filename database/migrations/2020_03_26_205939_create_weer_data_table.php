<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weerData', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id')->unsigned();
            $table->integer('temp');
            $table->integer('rainChance');
            $table->timestamp('dateTime');
            $table->timestamps();
        });
        Schema::table('weerData', function($table){
            $table->foreign('location_id')
                ->references('id')->on('locations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weerData');
    }
}
