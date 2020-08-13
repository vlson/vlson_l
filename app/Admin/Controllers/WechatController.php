<?php

namespace App\Admin\Controllers;

use App\Models\Blog\CosResourceModel;
use App\ThirdPart\Wechat\WechatOfficial;
use Encore\Admin\Actions\BatchRestore;
use Encore\Admin\Actions\Restore;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Redis;

class WechatController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '静态文件上传COS-后台';

    /**
     * Notes: 获取微信公众号access_token
     * Created by lxj at 2020/8/13 21:20
     */
    public function WechatOfficialAccessToken(){
        $access_token = Redis::get('wechat_official_access_token');
        $expire_time = Redis::ttl('wechat_official_access_token');
        if(!$access_token || $expire_time < 300){
            try{
                $access_data = WechatOfficial::getAccessToken();
                $access_token = $access_data['access_token'];
                $expire_time = $access_data['expires_in'];
                Redis::set('wechat_official_access_token', $access_token);
                Redis::expire('wechat_official_access_token', $expire_time);
            }catch(\Exception $e){
                return response('获取公众号access_token出错，原因为：'.$e->getMessage());
            }
        }
        //return view('exception.access_token');
        return response('微信公众号access_token为：'.$access_token."<br/>剩余到期时间为：".$expire_time.'秒');
    }
}
