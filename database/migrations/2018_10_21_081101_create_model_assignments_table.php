<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->enum('mode', ['Assignment', 'Test', 'Exam']);
            $table->enum('status', ['Not Submitted', 'Submitted', 'Graded']);
            $table->boolean('is_on_time');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
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
        Schema::dropIfExists('assignments');
    }
}
