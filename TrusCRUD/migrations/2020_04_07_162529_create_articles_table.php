<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            
			$table->id();
			$table->string('title');
			$table->string('cover');
			$table->string('permalink');
			$table->text('content');
			$table->string('description');
			$table->string('tags');
			$table->dateTime('published_at');
            $table->bigInteger('category_id')->unsigned();
            
            $table->bigInteger('author_id')->unsigned();

            $table->timestamps();

            $table->unique('permalink');
            $table->index(['id','title', 'permalink', 'category_id',]);

            $table->foreign('category_id')->references('id')->on('article_categories');
            $table->foreign('author_id')->references('id')->on('users');
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
