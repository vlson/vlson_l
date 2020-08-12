<?php

namespace App\Http\Controllers\Wechat;

use App\Jobs\Queue;
use App\Models\Blog\BlogArticleModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WechatController extends Controller
{
    public function tokenValid(Request $request){
        $request_data = $request->all();
        if($this->checkSignature($request_data)){
            return \response($request_data['echostr']);
        }
        return \response('Not True');
    }

    /**
     * Notes: 验证微信公众号Token
     * Created by lxj at 2020/8/12 22:55
     * @return int
     */
    private function checkSignature($request_data)
    {
        $signature = $request_data["signature"] ?? '';
        $timestamp = $request_data["timestamp"] ?? '';
        $nonce = $request_data["nonce"] ?? '';

        $token = env('WECHAT_OFFICIAL_TOKEN');

        $tmpArr = [$token, $timestamp, $nonce];
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}
