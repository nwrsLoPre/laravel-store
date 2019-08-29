<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->integer('category_id')->nullable()->references('id')->on('blog_categories');
            $table->timestamps();
            $table->string('photo')->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('description');
            $table->text('content');
            $table->string('status');
            $table->integer('views');
            $table->integer('comments');
        });

        Schema::create('blog_tag_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->references('id')->on('blog_posts')->onDelete('CASCADE');
            $table->integer('tag_id')->references('id')->on('blog_tags')->onDelete('CASCADE');
        });

        Schema::create('blog_post_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->references('id')->on('regions')->onDelete('CASCADE');
            $table->integer('post_id')->references('id')->on('blog_posts')->onDelete('CASCADE');
            $table->string('content', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post_comments');
        Schema::dropIfExists('blog_tag_assignments');
        Schema::dropIfExists('blog_post_photos');
        Schema::dropIfExists('blog_posts');
    }
}
