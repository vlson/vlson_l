<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_category', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('cat_name', 20)->default('')->nullable(false)->comment('分类名称');
            $table->string('logo', 100)->default('')->nullable(false)->comment('分类logo');
            $table->unsignedBigInteger('parent_id')->default(0)->nullable(false)->comment('父级分类ID');
            $table->unsignedTinyInteger('level')->default(0)->nullable(false)->comment('分类级别');

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
        Schema::dropIfExists('blog_category');
    }
}
