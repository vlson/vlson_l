<?php


namespace App\ThirdPart\Wechat;

/**
 * Notes: 微信公众号相关
 * Created by lxj at 2020/8/13 21:52
 */
class WechatOfficial
{
    /**
     * Notes: 获取access_token
     * Created by lxj at 2020/8/13 21:53
     */
    public static function getAccessToken(){
        $appId = env('WECHAT_OFFICIAL_APPID');
        $appSecret = env('WECHAT_OFFICIAL_AppSecret');
        $url ='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appId.'&secret='.$appSecret;
        return http_curl($url,'get','json');
    }
}
