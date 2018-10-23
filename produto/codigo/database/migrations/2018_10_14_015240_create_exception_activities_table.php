<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExceptionActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_exceptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('activity_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::table('priorities', function($table) {
            $table->foreign('name')->references('name')->on('activities');
            $table->foreign('activity_id')->references('id')->on('activities');
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
        Schema::dropIfExists('activity_exceptions');
    }
}
