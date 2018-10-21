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
            $table->string('title', 50);
            $table->text('description');
            $table->enum('mode', ['ASSIGNMENT', 'TEST', 'EXAM']);
            $table->boolean('status');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('course')->unsigned();
            $table->foreign('course')->references('id')->on('courses');
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
