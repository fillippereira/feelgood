<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExceptionHumorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('humor_exceptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('humor_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::table('priorities', function($table) {
            $table->foreign('name')->references('name')->on('humors');
            $table->foreign('humor_id')->references('id')->on('humors');
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
        Schema::dropIfExists('humor_exceptions');
    }
}
