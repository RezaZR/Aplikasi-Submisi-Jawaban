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
            $table->integer('assignment_id')->nullable()->unsigned();
            $table->foreign('assignment_id')->references('id')->on('assignments');
            $table->integer('student_id')->nullable()->unsigned();
            $table->foreign('student_id')->references('id')->on('users');
            $table->text('file')->nullable();
            $table->integer('grader')->nullable()->unsigned();
            $table->foreign('grader')->references('id')->on('users');
            $table->dateTime('examine_time')->nullable();
            $table->float('grade')->nullable();
            $table->enum('status', ['Not Submitted', 'Submitted', 'Graded'])->nullable();
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
