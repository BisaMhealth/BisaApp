<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserHealthInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_health_infos', function (Blueprint $table) {
            $table->increments('health_info_id');
            $table->unsignedInteger('uid');
            $table->string('height');
            $table->string('weight');
            $table->text('health_conditions');
            $table->text('allergies');
            $table->text('current_medication');
            $table->text('other_notes');
            $table->timestamps();
        });

        Schema::table('user_health_infos', function(Blueprint $table) {
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
        Schema::dropIfExists('user_health_infos');
    }
}
