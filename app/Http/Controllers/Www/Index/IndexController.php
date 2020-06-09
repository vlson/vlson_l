<?php

namespace App\Http\Controllers\Www\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 博客首页
 * add by lxj 2020-06-05
 * Class IndexController
 * @package App\Http\Controllers\Blog\Index
 */
class IndexController extends Controller
{
    public function index()
    {
        return view('www.index.index');
    }
}
