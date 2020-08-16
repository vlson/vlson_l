<?php

/**
 * Notes: 图片oss存储域名拼接
 * User: Administrator
 * Created by lxj at 2020/7/6 10:52
 * @param $path
 * @return string
 */
function imageDomainStitching($path)
{
    return 'https://'.env('ALIYUN_OSS_BUCKET').'.'.env('ALIYUN_OSS_ENDPOINT').'/'.$path;
}

/**
 * Notes: curl执行http请求
 * Created by lxj at 2020/8/13 21:59
 * @param $url
 * @param string $type
 * @param string $res
 * @param string $arr
 * @return bool|mixed|string
 * @throws Exception
 */
function http_curl($url, $type='get', $res='', $arr=''){
    // 1.初始化
    $ch = curl_init();
    // 2.设置参数
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    if($type == 'post'){
        // 如果是post请求的话,设置post的一些参数
        curl_setopt($ch , CURLOPT_POST , 1);
        curl_setopt($ch , CURLOPT_POSTFIELDS, $arr);
    }
    // 3.执行
    $result = curl_exec($ch);
    if(curl_errno($ch)){
        throw new Exception(curl_error($ch));// 抛出错误日志
    }
    // 4.关闭
    curl_close($ch);
    if($res == 'json'){
        // 将json转化成数组的形式
        $result = json_decode($result , TRUE);
    }
    return $result;
}
