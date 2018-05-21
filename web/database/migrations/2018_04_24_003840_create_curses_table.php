<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->boolean('premium')->default(false);
            $table->tinyInteger('lessons');
            $table->string('image')->default('curses/default.jpg');
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
        Schema::dropIfExists('curses');
    }
}
