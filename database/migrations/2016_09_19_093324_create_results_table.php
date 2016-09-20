<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultsTable extends Migration {

    public function up()
    {
        Schema::create('results', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_lesson_id')->index();
            $table->integer('answer_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('results');
    }
}