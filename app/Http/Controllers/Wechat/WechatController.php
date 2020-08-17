<?php

namespace App\Http\Controllers\Wechat;

use App\Jobs\Queue;
use App\Models\Blog\BlogArticleModel;
use App\Http\Controllers\Controller;
use App\ThirdPart\Wechat\WechatOfficial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{
    public function tokenValid(Request $request){
        if($request->isMethod("GET")){
            $request_data = $request->all();
            if(WechatOfficial::checkSignature($request_data)){
                return \response($request_data['echostr']);
            }
            return \response('Not True');
        }elseif ($request->isMethod("POST")){
            //<xml><ToUserName><![CDATA[gh_64bb600962f3]]><\/ToUserName>\n<FromUserName><![CDATA[oMddr6E4gCP1MLo43d3yjVhs8L64]]><\/FromUserName>\n<CreateTime>1597660427<\/CreateTime>\n<MsgType><![CDATA[text]]><\/MsgType>\n<Content><![CDATA[\u6d4b\u8bd5]]><\/Content>\n<MsgId>22872994984434945<\/MsgId>\n<\/xml>
            $xml_data = file_get_contents('php://input');

        }
    }
}
