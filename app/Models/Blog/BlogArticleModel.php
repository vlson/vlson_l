<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogArticleModel extends BasicModel
{
    protected $table = 'blog_article';

    /**
     * Notes：
     * Created by lxj 2020/4/11 15:25
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories():BelongsToMany
    {
        return $this->belongsToMany(BlogCategoryModel::class, (new BlogArticleCategoryModel())->getTable(), 'art_id', 'cat_id');
    }
}
