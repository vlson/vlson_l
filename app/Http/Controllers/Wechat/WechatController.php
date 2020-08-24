<?php

namespace App\Http\Controllers\Wechat;

use App\Jobs\Queue;
use App\Models\Blog\BlogArticleModel;
use App\Http\Controllers\Controller;
use App\ThirdPart\Wechat\Official\WXBizMsgCrypt;
use App\ThirdPart\Wechat\WechatOfficial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{
    public function tokenValid(Request $request){
        $request_data = $request->all();
        if($request->isMethod("GET")){
            if(WechatOfficial::checkSignature($request_data)){
                return \response($request_data['echostr']);
            }
            return \response('Not True');
        }elseif ($request->isMethod("POST")){
            $signature = $request_data['signature'];
            $timestamp = $request_data['timestamp'];
            $nonce = $request_data['nonce'];
            $openid = $request_data['openid'];
            $xml_data = file_get_contents('php://input');

            $msg = '';
            if(isset($request_data['encrypt_type'])){// 加密|兼容模式
                $encrypt_type = $request_data['encrypt_type'];
                $msg_signature = $request_data['msg_signature'];

                $cryptObj = new WXBizMsgCrypt(config('wechat.official.token'), config('wechat.official.EncodingAESKey'), config('wechat.official.appId'));
                $errCode = $cryptObj->decryptMsg($msg_signature, $timestamp, $nonce, $xml_data, $msg);

                if ($errCode == 0) {
                    Log::debug('密文：解密后消息为：'.$msg. "\n");
                } else {
                    Log::error('解密出错，错误码为：'.$errCode);
                }
            }else{// 明文模式
                $msg = $xml_data;
                Log::debug('明文：解密后消息为：'.$msg. "\n");
            }

            $trans_data = xmlToArray($msg);
            Log::debug('XML转ARRAY后：'.json_encode($trans_data));
        }
    }
}
