<?php


namespace App\ThirdPart\Wechat;

use App\ThirdPart\Wechat\Official\WXBizMsgCrypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

/**
 * Notes: 微信公众号相关
 * Created by lxj at 2020/8/13 21:52
 */
class WechatOfficial
{
    /**
     * @var 微信公众号AppId
     */
    private static $appId;

    /**
     * @var 微信公众号AppSecret
     */
    private static $appSecret;


    /**
     * @var 微信公众号AccessToken
     */
    private static $accessToken;

    /**
     * @var 用户自定义的微信公众号token
     */
    private static $token;

    /**
     * Notes: 设置必要参数值
     * Created by lxj at 2020/8/15 19:51
     */
    private static function setProperty(){
        self::$appId = config('wechat.official.appId');
        self::$appSecret = config('wechat.official.appSecret');
        self::$token = config('wechat.official.token');
        self::$accessToken = self::getAccessTokenCache();
    }

    /**
     * Notes: 验证微信公众号Token
     * Created by lxj at 2020/8/12 22:55
     * @return int
     */
    public static function checkSignature($request_data)
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

    /**
     * Notes: 获取access_token
     * Created by lxj at 2020/8/16 11:37
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    private static function getAccessTokenCache(){
        $access_token = Redis::get('wechat_official_access_token');
        $expire_time = Redis::ttl('wechat_official_access_token');
        if(!$access_token || $expire_time < 300){
            try{
                $access_data = self::getAccessToken();
                $access_token = $access_data['access_token'];
                $expire_time = $access_data['expires_in'];
                Redis::set('wechat_official_access_token', $access_token);
                Redis::expire('wechat_official_access_token', $expire_time);
            }catch(\Exception $e){
                return response('获取公众号access_token出错，原因为：'.$e->getMessage());
            }
        }
        return $access_token;
    }

    /**
     * Notes: 获取access_token
     * Created by lxj at 2020/8/13 21:53
     */
    public static function getAccessToken(){
        self::$appId = config('wechat.official.appId');
        self::$appSecret = config('wechat.official.appSecret');
        $url ='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.self::$appId.'&secret='.self::$appSecret;
        return httpCurl($url,'get', 'json');
    }

    /**
     * Notes: 查询公众号菜单按钮
     * Created by lxj at 2020/8/15 21:11
     * @return bool|mixed|string
     * @throws \Exception
     */
    public static function getMenu(){
        self::setProperty();
        $url = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token='.self::$accessToken;
        return httpCurl($url,'get');
    }

    /**
     * Notes: 设置公众号菜单按钮
     * Created by lxj at 2020/8/15 23:07
     * @param $menu_info
     * @return bool|mixed|string
     * @throws \Exception
     * 1.自定义菜单最多包括3个一级菜单，每个一级菜单最多包含5个二级菜单。
     * 2.一级菜单最多4个汉字，二级菜单最多7个汉字，多出来的部分将会以“...”代替。
     */
    public static function setMenu($menu_info){
        self::setProperty();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.self::$accessToken;
        return httpCurl($url,'post','', json_encode($menu_info, JSON_UNESCAPED_UNICODE));
    }

    /**
     * Notes: 删除公众号菜单按钮
     * Created by lxj at 2020/8/18 8:29
     * @return bool|mixed|string
     * @throws \Exception
     */
    public static function delMenu(){
        self::setProperty();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.self::$accessToken;
        return httpCurl($url,'get');
    }

    /**
     * Notes: 解密微信服务器推送过来的加密消息
     * Created by lxj at 2020/8/25 21:31
     * @param $msg_signature
     * @param $timestamp
     * @param $nonce
     * @param $xml_data
     * @param $msg
     * @return int
     */
    public static function decryptMessage($msg_signature, $timestamp, $nonce, $xml_data, &$msg){
        $cryptObj = new WXBizMsgCrypt(config('wechat.official.token'), config('wechat.official.EncodingAESKey'), config('wechat.official.appId'));
        return $cryptObj->decryptMsg($msg_signature, $timestamp, $nonce, $xml_data, $msg);
    }

    /**
     * Notes: 向微信服务器推送的消息加密
     * Created by lxj at 2020/8/28 17:00
     * @param $xml_data
     * @param $timestamp
     * @param $nonce
     * @param $encrypt_msg
     * @return int
     */
    public static function encryptMessage($xml_data, $timestamp, $nonce){
        $cryptObj = new WXBizMsgCrypt(config('wechat.official.token'), config('wechat.official.EncodingAESKey'), config('wechat.official.appId'));
        $timestamp = $timestamp ?? time();
        $encrypt_msg = '';
        $cryptObj->encryptMsg($xml_data, $timestamp, $nonce, $encrypt_msg);
        return $encrypt_msg;
    }

    /**
     * Notes:生成回复微信公众号的消息体
     * Created by lxj at 2020/9/27 8:48
     * @param $open_id
     * @param $msg_type
     * @param string $msg_content
     * @param $nonce
     * @return int
     */
    public static function replyMsg($open_id, $msg_type, $msg_content = '', $nonce){
        // 人工智能算法计算回复的消息
        $emoji_data = [
            'o(*￣▽￣*)ブ',
            'φ(゜▽゜*)♪',
            '(★ ω ★)',
            '(‾◡◝)',
            '( *︾▽︾)',
            '(✿◕‿◕✿)',
            '(⓿_⓿)',
            '( ఠൠఠ )ﾉ',
            '（づ￣3￣）づ╭❤～'
        ];
        $emoji = $emoji_data[array_rand($emoji_data)];

        // 拼凑回复的消息
        $reply_msg = '';
        if($msg_type == 'text'){
            $reply_msg = $msg_content;
            $reply_msg = str_replace('吗', '', $reply_msg);
            $reply_msg = str_replace('?', '!', $reply_msg);
            $reply_msg = str_replace('？', '!', $reply_msg);
            $reply_msg = str_replace('我', '你', $reply_msg);
            $reply_msg = str_replace('你', '我', $reply_msg);

            $reply_msg .= $emoji;
            $reply_msg = self::makeText($open_id, $reply_msg);
        }else{
            $reply_msg = '非常荣幸与您沟通，由于个人不能实时在线，看到消息会立即回复您!'.$emoji;
            $reply_msg = self::makeText($open_id, $reply_msg);
        }

        return self::encryptMessage($reply_msg, time(), $nonce);
    }

    /**
     * Notes: 拼接要回复的文本消息
     * Created by lxj at 2020/8/26 21:21
     * @param $open_id
     * @param string $text
     * @return string
     */
    private static function makeText($open_id, $text = ''){
        $create_time = time();
        $text_tpl = "<xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime>$create_time</CreateTime>
              <MsgType><![CDATA[text]]></MsgType>
              <Content><![CDATA[%s]]></Content>
            </xml>";

        return sprintf($text_tpl, $open_id, config("wechat.official.wechatID"), $text);
    }
}
