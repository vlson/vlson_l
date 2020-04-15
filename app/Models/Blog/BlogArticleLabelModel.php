<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticleLabelModel extends BasicModel
{
    use SoftDeletes;

    protected $table = 'blog_article_label';
}
