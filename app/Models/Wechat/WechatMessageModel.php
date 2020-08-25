<?php

namespace App\Models\Wechat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WechatMessageModel extends Model
{
    use SoftDeletes;

    protected $table = 'wechat_message';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
