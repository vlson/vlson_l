<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogArticleModel extends BasicModel
{
    use SoftDeletes;

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
     * Notes: 与标签为多对多关系
     * User: Administrator
     * Created by lxj at 2020/4/15 21:47
     * @return BelongsToMany
     */
    public function labels():BelongsToMany
    {
        return $this->belongsToMany(BlogLabelModel::class, with(new BlogArticleLabelModel())->getTable(), 'art_id', 'label_id');
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
