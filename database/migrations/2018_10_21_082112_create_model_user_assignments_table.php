<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelUserAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_name')->unsigned();
            $table->foreign('student_name')->references('id')->on('users');
            $table->text('file_name');
            $table->dateTime('submission_time');
            $table->integer('grader')->unsigned();
            $table->foreign('grader')->references('id')->on('users');
            $table->dateTime('examine_time');
            $table->float('grade');
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
        Schema::dropIfExists('user_assignments');
    }
}
