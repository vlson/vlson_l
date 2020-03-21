<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticleLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_label', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('art_id')->default(0)->nullable(false)->comment('文章ID');
            $table->unsignedBigInteger('label_id')->default(0)->nullable(false)->comment('标签ID');
            $table->unsignedTinyInteger('is_deleted')->default(0)->nullable(false)->comment('软删除标识：0正常，1已删除');

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
        Schema::dropIfExists('blog_article_label');
    }
}
