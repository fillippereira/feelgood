<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterThoughtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_thoughts', function (Blueprint $table) {
           
            $table->integer('register_id')->unsigned();
            $table->foreign('register_id')->references('id')->on('registers');
            $table->integer('thought_id')->unsigned();
            $table->foreign('thought_id')->references('id')->on('thoughts');
            $table->integer('intensity_feeling');
            $table->timestamps();
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_feelings');
    }
}
