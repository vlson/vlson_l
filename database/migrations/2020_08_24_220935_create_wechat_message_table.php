<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('wechat_message');
        Schema::create('wechat_message', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msg_id', 25)->default('')->nullable(false)->comment('消息ID');
            $table->string('open_id', 50)->default('')->nullable(false)->comment('用户OpenID');
            $table->integer('create_time')->default(0)->unsigned()->nullable(false)->comment('创建时间');
            $table->string('msg_type', 25)->default('')->nullable(false)->comment('消息类型');
            $table->string('msg_content', 255)->default('')->nullable(true)->comment('消息内容');
            $table->string('media_id', 255)->default('')->nullable(true)->comment('消息媒体ID');
            $table->string('pic_url', 125)->default('')->nullable(true)->comment('图片链接');
            $table->string('format', 25)->default('')->nullable(true)->comment('语音格式');
            $table->text('recognition')->comment('语音识别结果');
            $table->string('thumb_media_id', 125)->default('')->nullable(true)->comment('视频消息缩略图的媒体id');
            $table->string('location_x', 25)->default('')->nullable(true)->comment('地理位置维度');
            $table->string('location_y', 25)->default('')->nullable(true)->comment('地理位置经度');
            $table->string('scale', 25)->default('')->nullable(true)->comment('地图缩放大小');
            $table->string('label', 255)->default('')->nullable(true)->comment('地理位置信息');

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
        Schema::dropIfExists('wechat_message');
    }
}
