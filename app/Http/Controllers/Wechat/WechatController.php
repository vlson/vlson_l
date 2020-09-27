<?php

namespace App\Http\Controllers\Wechat;

use App\Jobs\Queue;
use App\Models\Blog\BlogArticleModel;
use App\Http\Controllers\Controller;
use App\Models\Wechat\WechatMessageModel;
use App\ThirdPart\Wechat\Official\WXBizMsgCrypt;
use App\ThirdPart\Wechat\WechatOfficial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{
    /**
     * Notes: 接收微信服务器消息
     * Created by lxj at 2020/8/26 14:16
     * @param Request $request
     * @return bool|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function tokenValid(Request $request){
        $request_data = $request->all();
        if($request->isMethod("GET")){// 1. 验证token
            if(WechatOfficial::checkSignature($request_data)){
                return \response($request_data['echostr']);
            }
            return \response('Not True');
        }elseif ($request->isMethod("POST")){// 2. 接收微信公众号平台推送过来的消息
            $openid = $request_data['openid'];
            $xml_data = file_get_contents('php://input');

            $msg = '';
            $timestamp = $request_data['timestamp'];
            $nonce = $request_data['nonce'];
            if(isset($request_data['encrypt_type'])){// 加密|兼容模式
                //$encrypt_type = $request_data['encrypt_type'];
                $msg_signature = $request_data['msg_signature'];

                $errCode = WechatOfficial::decryptMessage($msg_signature, $timestamp, $nonce, $xml_data, $msg);
                if ($errCode == 0) {
                    Log::debug('密文：解密后消息为：'.$msg. "\n");
                } else {
                    Log::error('密文解密出错，密文为：'.$xml_data.'，错误码为：'.$errCode);
                    return false;
                }
            }else{// 明文模式
                $msg = $xml_data;
                Log::debug('明文：解密后消息为：'.$msg. "\n");
            }

            $reply = $this->persistentMsgAndGetReply($msg, $nonce);
            Log::info('回复的消息为：' . $reply);
            return \response($reply);
        }
    }

    /**
     * Notes:持久化消息并获取回复
     * Created by lxj at 2020/9/27 8:32
     * @param $msg
     * @param $nonce
     */
    private function persistentMsgAndGetReply($msg, $nonce){
        // 消息格式：XML转数组
        $msg_data = xmlToArray($msg);
        Log::debug('XML转ARRAY后：'.json_encode($msg_data));

        // 持久化消息
        $content = $msg_data['Content'] ?? '';

        // 消息持久化重复判断
        $is_persistence = WechatMessageModel::query()->where(['msg_id'=>$msg_data['MsgId']])->first();
        if(!$is_persistence){
            $persistent_data = [];
            $persistent_data['msg_id'] = $msg_data['MsgId'] ?? '';
            $persistent_data['open_id'] = $msg_data['FromUserName'] ?? '';
            $persistent_data['create_time'] = $msg_data['CreateTime'] ?? '';
            $persistent_data['msg_type'] = $msg_data['MsgType'] ?? '';
            $persistent_data['msg_content'] = $content ?? '';
            $persistent_data['media_id'] = $msg_data['MediaId'] ?? '';
            $persistent_data['pic_url'] = $msg_data['PicUrl'] ?? '';
            $persistent_data['format'] = $msg_data['Format'] ?? '';
            $persistent_data['recognition'] = $msg_data['Recognition'] ?? '';
            $persistent_data['thumb_media_id'] = $msg_data['ThumbMediaId'] ?? '';
            $persistent_data['location_x'] = $msg_data['Location_X'] ?? '';
            $persistent_data['location_y'] = $msg_data['Location_Y'] ?? '';
            $persistent_data['scale'] = $msg_data['Scale'] ?? '';
            $persistent_data['label'] = $msg_data['Label'] ?? '';
            $save_res = WechatMessageModel::query()->insert($persistent_data);
            if(!$save_res){
                Log::error('持久化消息出错，待持久化的数据为：' . json_encode($persistent_data));
            }
        }

        // 回复消息
        echo WechatOfficial::replyMsg($msg_data['FromUserName'], $msg_data['MsgType'], $content, $nonce);
    }
}
