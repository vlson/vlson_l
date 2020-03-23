<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategoryModel extends BasicModel
{
    use SoftDeletes;

    protected $table = 'blog_category';

    protected $dates = ['deleted_at'];


    public function parentCategory(){
        return $this->belongsTo(self::class, "parent_id", 'id');
    }


    public function childrenCategory(){
        return $this->hasMany(self::class, 'id', "parent_id");
    }
}
