<?php

namespace App\Http\Controllers\Blog;

use App\Jobs\Queue;
use App\Models\Blog\BlogArticleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class IndexController extends Controller
{
    public function index()
    {
        $limit = 5;
        $articleList = BlogArticleModel::query()
            ->select(['id', 'title', 'summary', 'cover', 'updated_at'])
            ->where(['deleted_at'=>null])->orderByDesc('updated_at')->paginate($limit);

        return view('blog.index.index', ['articleList'=>$articleList]);
    }

    public function testQueue(Request $request)
    {

        $res = Queue::dispatch($request->all());
         echo \response()->json(['code'=>200, 'msg'=>"success"]);
    }
}
