<?php


namespace App\ThirdPart\Wechat;

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
     * Notes: 设置必要参数值
     * Created by lxj at 2020/8/15 19:51
     */
    private static function setProperty(){
        /*foreach (get_class_vars(self::class) as $key=>$value){
            if(!isset(self::$$key)){
                self::$$key = config('wechat.official.'.$key);
            }
        }*/
        self::$appId = config('wechat.official.appId');
        self::$appSecret = config('wechat.official.appSecret');
        self::$accessToken = self::getAccessTokenCache();
    }

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
        self::setProperty();
        $url ='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.self::$appId.'&secret='.self::$appSecret;
        return http_curl($url,'get','json');
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
        return http_curl($url,'get');
    }

    /**
     * Notes: 设置公众号菜单按钮
     * Created by lxj at 2020/8/15 23:07
     * @param $menu_info
     * @return bool|mixed|string
     * @throws \Exception
     */
    public static function setMenu($menu_info){
        self::setProperty();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.self::$accessToken;
        return http_curl($url,'post','', $menu_info);
    }

    public static function delMenu(){}
}
