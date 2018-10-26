<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelLecturerCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturer_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lecturer_name')->unsigned();
            $table->foreign('lecturer_name')->references('id')->on('users');
            $table->integer('course_name')->unsigned();
            $table->foreign('course_name')->references('id')->on('courses');
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
        Schema::dropIfExists('lecturer_courses');
    }
}
