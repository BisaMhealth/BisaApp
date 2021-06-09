<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('article_id');
            $table->unsignedInteger('article_cat_id');
            $table->string('article_title');
            $table->text('article_thumbnail');
            $table->mediumText('article_content');
            $table->integer('article_upvotes')->default(0);
            $table->integer('article_downvotes')->default(0);
            $table->integer('article_views')->default(0);
            $table->unsignedInteger('article_author')->default(0);
            $table->timestamps();
        });

        Schema::table('articles', function(Blueprint $table) {
            $table->foreign('article_cat_id')->references('category_id')->on('article_categories');
            $table->foreign('article_author')->references('admin_id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
