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
            $table->string('npm')->unique()->nullable();
            $table->string('nik')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('level', ['Admin', 'Lecturer', 'Assistant', 'Student']);
            $table->string('phone_number');
            $table->text('address');
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
