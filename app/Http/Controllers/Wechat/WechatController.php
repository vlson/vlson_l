<?php

namespace App\Http\Controllers\Wechat;

use App\Jobs\Queue;
use App\Models\Blog\BlogArticleModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WechatController extends Controller
{
    public function checkSignature(Request $request)
    {
        $request_data = $request->all();
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
