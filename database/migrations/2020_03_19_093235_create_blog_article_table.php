<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title', 50)->default('')->nullable(false)->comment('标题');
            $table->unsignedBigInteger('author')->default(0)->nullable(false)->comment('作者ID');
            $table->string('summary', 200)->default('')->nullable(false)->comment('摘要');
            $table->string('cover', 100)->default('https://vlson.oss-cn-beijing.aliyuncs.com/site背景.jpg')->nullable(false)->comment('封面');
            $table->longText('content')->default('')->nullable(false)->comment('内容');
            $table->unsignedTinyInteger('like_num')->default(0)->nullable(false)->comment('点赞量');
            $table->unsignedTinyInteger('read_num')->default(0)->nullable(false)->comment('阅读量');
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
        Schema::dropIfExists('blog_article');
    }
}
