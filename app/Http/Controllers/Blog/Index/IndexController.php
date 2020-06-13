<?php

namespace App\Http\Controllers\Blog\Index;

use App\Models\Blog\BlogArticleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $limit = 1;
        $articleList = BlogArticleModel::query()
            ->select(['id', 'title', 'summary', 'cover', 'updated_at'])
            ->where(['deleted_at'=>null])->orderByDesc('updated_at')->paginate($limit);

        return view('blog.index.index', ['articleList'=>$articleList]);
    }
}
