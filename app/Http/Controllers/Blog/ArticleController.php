<?php

namespace App\Http\Controllers\Blog;

use App\Jobs\Queue;
use App\Models\Blog\BlogArticleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    public function detail($article_id)
    {
        try{
            $article = BlogArticleModel::getArticle($article_id);

            // 获取上一篇，下一篇
            $article['prev'] = BlogArticleModel::getArticle($article_id - 1);
            $article['next'] = BlogArticleModel::getArticle($article_id + 1);
        }catch(\Exception $e){
            Log::error('文章['.$article_id.']详情页错误：'.$e->getMessage());
            return redirect('/');
        }

        $article['read_num'] = Redis::zscore('article_read_num', 'blog_'.$article_id);
        Redis::zincrby('article_read_num', 1, 'blog_'.$article_id);

        return view('blog.article.detail', ['article'=>$article]);
    }
}
