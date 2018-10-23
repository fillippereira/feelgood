<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExceptionFeelingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeling_exceptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('feeling_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::table('priorities', function($table) {
            $table->foreign('name')->references('name')->on('feelings');
            $table->foreign('feeling_id')->references('id')->on('feelings');
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
        Schema::dropIfExists('feeling_exceptions');
    }
}
