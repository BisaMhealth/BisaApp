<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('doctor_id');
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('country');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->text('bio');
            $table->string('thumbnail');
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('doctors');
    }
}
