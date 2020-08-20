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
            /*$xml_data = '<xml>
                            <ToUserName><![CDATA[gh_8e2807c9b3d1]]></ToUserName>
                            <FromUserName><![CDATA[oyjnx5xfqorRKfLISVAoConaf3II]]></FromUserName>
                            <CreateTime>1597883172</CreateTime>
                            <MsgType><![CDATA[text]]></MsgType>
                            <Content><![CDATA[good ]]></Content>
                            <MsgId>22876188241113008</MsgId>
                            <Encrypt><![CDATA[xolDz6Y+SUU91xLGSgJkhSH/zQPuV8GQ2Qru8gZ9usyllFpLBeP7OBVnxmepWSaD1bqS/ahGlcqiithYjbP87/utJsWHvUJmAoV/j9U631Se0uMfVS+27F7JigVsU/N1eKpdBpayyXT7CbR2dtFYEaEoGIMIn92tAXy2cUKAnearqSk1CGr20+vRBnOmV6tgiYKyio6+PXP0obfUQ5wgHpKFNe64wYFHLXzeszMnXGk8bg35VFwykEKAipRlMisN1dk5C25zcnpBshaXwRyoVxVqzSliJdWfBGfzkrg9bkDs0NIyX4H5iREMubRgpqagsbW9tBkDvLA6/OU8fWHOnD2Fl7eFNXMbeTooKV6P5Wi8Z3EcIbjdd243CRWe/akUwGROdjmvrzY0n/3JZgYZYtgRX58MqVcsYy8lQiCVpdo=]]></Encrypt>
                        </xml>';*/

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
        }
    }
}
