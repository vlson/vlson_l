<?php

namespace App\Models\Blog;

use App\Models\BasicModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogLabelModel extends BasicModel
{
    use SoftDeletes;

    protected $table = 'blog_label';
    protected $dates = ['deleted_at'];
}
