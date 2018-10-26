<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelAssistantCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assistant_name')->unsigned();
            $table->foreign('assistant_name')->references('id')->on('users');
            $table->integer('course_name')->unsigned();
            $table->foreign('course_name')->references('id')->on('courses');
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
        Schema::dropIfExists('model_assistant_courses');
    }
}
