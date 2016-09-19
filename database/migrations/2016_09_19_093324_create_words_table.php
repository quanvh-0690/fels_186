<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWordsTable extends Migration {

    public function up()
    {
        Schema::create('words', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->index();
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('words');
    }
}