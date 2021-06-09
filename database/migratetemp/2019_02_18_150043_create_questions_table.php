<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('question_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('question_cat_id');
            $table->text('question_content');
            $table->text('question_media_url');
            $table->string('question_closed')->default('no');
            $table->string('question_answered')->default('no');
            $table->string('question_code');
            $table->timestamps();
        });

        Schema::table('questions', function(Blueprint $table) {
            $table->foreign('patient_id')->references('user_id')->on('users');
            $table->foreign('question_cat_id')->references('category_id')->on('question_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
