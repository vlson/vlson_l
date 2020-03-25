<?php

namespace App\Models\Blog;

use App\Models\BasicModel;

class BlogArticleModel extends BasicModel
{
    protected $table = 'blog_article';

    public function category()
    {
        return $this->belongsToMany(BlogCategoryModel::class, (new BlogArticleCategoryModel())->getTable(), 'art_id', 'cat_id');
    }
}
