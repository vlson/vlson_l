<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BlogArticleModel extends BasicModel
{
    protected $table = 'blog_article';

    /**
     * Notes：与分类为多对多关系
     * Created by lxj 2020/4/11 15:25
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories():BelongsToMany
    {
        return $this->belongsToMany(BlogCategoryModel::class, (new BlogArticleCategoryModel())->getTable(), 'art_id', 'cat_id');
    }

    /**
     * Notes：与作者为多对一关系
     * Created by lxj 2020/4/13 17:11
     * @return BelongsTo
     */
    public function writer(): BelongsTo
    {
        return $this->belongsTo(Administrator::class, 'author');
    }
}
