<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersTable extends Migration {

    public function up()
    {
        Schema::create('answers', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('word_id')->index();
            $table->text('content');
            $table->boolean('is_correct');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('answers');
    }
}