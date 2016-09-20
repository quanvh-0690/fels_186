<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelationshipsTable extends Migration {

    public function up()
    {
        Schema::create('relationships', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('follower_id')->index();
            $table->integer('followed_id')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('relationships');
    }
}