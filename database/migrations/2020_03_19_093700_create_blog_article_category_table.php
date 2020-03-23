<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_category', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('art_id')->default(0)->nullable(false)->comment('文章ID');
            $table->unsignedBigInteger('cat_id')->default(0)->nullable(false)->comment('分类ID');

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
        Schema::dropIfExists('blog_article_category');
    }
}
