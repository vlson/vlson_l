<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class CosResourceModel extends Model
{
    /**
     * 与模型关联的数据表。
     *
     * @var string
     */
    protected $table = 'cos_resource';

    /**
     * 执行模型是否自动维护时间戳.
     *
     * @var bool
     */
    public $timestamps = true;
}
