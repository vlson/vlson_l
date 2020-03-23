<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategoryModel extends BasicModel
{
    use SoftDeletes;

    protected $table = 'blog_category';

    protected $dates = ['deleted_at'];
}
