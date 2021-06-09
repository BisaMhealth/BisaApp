<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_responses', function (Blueprint $table) {
            $table->increments('question_response_id');
            $table->unsignedInteger('ques_id');
            $table->integer('responder_id');
            $table->enum('responder_type', ['doctor', 'user']);
            $table->text('question_response_content');
            $table->text('question_response_media_url');
            $table->timestamps();
        });

        Schema::table('question_responses', function(Blueprint $table) {
            $table->foreign('ques_id')->references('question_id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_responses');
    }
}
