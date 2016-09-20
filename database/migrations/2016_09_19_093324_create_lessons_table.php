<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLessonsTable extends Migration {

    public function up()
    {
        Schema::create('lessons', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index();
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('lessons');
    }
}