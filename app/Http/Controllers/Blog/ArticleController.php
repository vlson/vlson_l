<?php

namespace App\Http\Controllers\Blog;

use App\Jobs\Queue;
use App\Models\Blog\BlogArticleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function detail($article_id)
    {
        try{
            $article = BlogArticleModel::getArticle($article_id);
        }catch(\Exception $e){
            Log::error('文章['.$article_id.']详情页错误：'.$e->getMessage());
            return redirect('/');
        }

        view('blog.article.detail', ['article'=>$article]);
    }
}
