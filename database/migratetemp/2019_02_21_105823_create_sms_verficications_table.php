<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsVerficicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_verficications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uid');
            $table->string('phone_number');
            $table->string('code');
            $table->enum('status', ['pending', 'verified'])->default('pending');
            $table->timestamps();
        });

        Schema::table('sms_verficications', function(Blueprint $table) {
            $table->foreign('uid')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_verficications');
    }
}
