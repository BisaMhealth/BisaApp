<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('first_name')->default('n/a');
            $table->string('last_name')->default('n/a');;
            $table->string('username')->unique();
            $table->string('email')->default('n/a');
            $table->string('phone')->default('n/a');
            $table->string('password');
            $table->enum('gender', ['n/a', 'male', 'female'])->default('n/a');;
            $table->string('date_of_birth')->default('n/a');
            $table->string('country')->default('n/a');;
            $table->string('address')->default('n/a');;
            $table->enum('type', ['anonymous','known']);
            $table->enum('source', ['web','mobile'])->default('mobile');
            $table->integer('active')->default(1);
            $table->string('token');
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
