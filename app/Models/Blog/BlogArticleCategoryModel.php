<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticleCategoryModel extends BasicModel
{
    use SoftDeletes;

    protected $table = 'blog_article_category';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
