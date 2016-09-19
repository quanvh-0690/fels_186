<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserLessonsTable extends Migration {

    public function up()
    {
        Schema::create('user_lessons', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('lesson_id')->index();
            $table->tinyInteger('status')->default(config('user_lesson.status.doing'));
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('user_lessons');
    }
}