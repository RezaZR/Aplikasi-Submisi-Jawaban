<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->dateTime('submission_time');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('course');
            $table->integer('submission_field_id')->unsigned();
            $table->foreign('submission_field_id')->references('id')->on('submission_field');
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
        Schema::dropIfExists('file');
    }
}
