<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogLabelModel extends BasicModel
{
    use SoftDeletes;

    protected $table = 'blog_label';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Notes: 与文章为多对多关系
     * User: Administrator
     * Created by lxj at 2020/4/15 21:48
     * @return BelongsToMany
     */
    public function article():BelongsToMany
    {
        return $this->belongsToMany(BlogArticleModel::class, with(new BlogArticleLabelModel())->getTable(), 'label_id', 'art_id');
    }
}
