<?php

namespace App\Http\Controllers\Wechat;

use App\Jobs\Queue;
use App\Models\Blog\BlogArticleModel;
use App\Http\Controllers\Controller;
use App\ThirdPart\Wechat\WechatOfficial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WechatController extends Controller
{
    public function tokenValid(Request $request){
        $request_data = $request->all();
        if(WechatOfficial::checkSignature($request_data)){
            return \response($request_data['echostr']);
        }
        return \response('Not True');
    }
}
