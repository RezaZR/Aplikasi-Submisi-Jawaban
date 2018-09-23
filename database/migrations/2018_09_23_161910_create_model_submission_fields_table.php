<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelSubmissionFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submission_field', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('description', 100);
            $table->enum('mode', ['ASSIGNMENT', 'TEST', 'EXAM']);
            $table->boolean('status');
            $table->float('grade');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('course');
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
        Schema::dropIfExists('submission_field');
    }
}
