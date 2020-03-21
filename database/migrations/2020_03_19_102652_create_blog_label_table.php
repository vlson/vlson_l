<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_label', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('label_name', 20)->default('')->nullable(false)->comment('标签名称');
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
        Schema::dropIfExists('blog_label');
    }
}
