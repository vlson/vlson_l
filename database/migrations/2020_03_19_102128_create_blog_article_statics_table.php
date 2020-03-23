<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticleStaticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_statics', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type', 20)->default('')->nullable(false)->comment('统计类型：点赞，阅读');
            $table->unsignedBigInteger('art_id')->default(0)->nullable(false)->comment('文章ID');
            $table->string('ip', 25)->default('0.0.0.0')->nullable(false)->comment('客户端IP');

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
        Schema::dropIfExists('blog_article_statics');
    }
}
