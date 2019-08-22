<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cover');
            $table->string('title');
            $table->string('category');
            $table->string('slug');
            $table->string('avatar');
            $table->string('author');
            $table->bigInteger('comments');
            $table->boolean('isHot');
            $table->string('time');
            $table->string('tag');
            $table->string('paragraph');
            $table->string('media');
            $table->string('adverts');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
