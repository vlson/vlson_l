<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategoryModel extends BasicModel
{
    use SoftDeletes;
    use ModelTree;

    protected $table = 'blog_category';

    protected $dates = ['deleted_at'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent_id');
        $this->setOrderColumn('id');
        $this->setTitleColumn('cat_name');
    }

    public function parentCategory(){
        return $this->belongsTo(self::class, "parent_id", 'id');
    }


    public function childrenCategory(){
        return $this->hasMany(self::class, 'id', "parent_id");
    }
}
