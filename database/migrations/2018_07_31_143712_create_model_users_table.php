<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_number')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('level', ['ADMIN', 'LECTURER', 'STUDENT', 'ASSISTANT']);
            $table->string('phone_number');
            $table->string('address');
            $table->date('birth_date');
            $table->enum('sex', ['MALE', 'FEMALE']);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
