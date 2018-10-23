<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('feelings');
            $table->string('quantification_feelings');
            $table->string('thoughts');
            $table->string('qualification_thoughts');
            $table->string('situation');
            $table->string('comportament');
            $table->timestamps();
        });

        Schema::table('priorities', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registers');
    }
}
