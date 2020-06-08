<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cos_resource', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('url', 250)->default('')->nullable(false)->comment('资源地址');
            $table->string('type', 50)->default('')->nullable(false)->comment('资源类型：image图片；css样式文件；js脚本文件；other其他');

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
        Schema::dropIfExists('cos_resource');
    }
}
