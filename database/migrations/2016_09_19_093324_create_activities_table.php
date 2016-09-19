<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitiesTable extends Migration {

    public function up()
    {
        Schema::create('activities', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('object_id');
            $table->tinyInteger('type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('activities');
    }
}