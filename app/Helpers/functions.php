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
 * Created by lxj at 2020/8/16 13:47
 * @param $url
 * @param string $type
 * @param string $res
 * @param string $data
 * @return bool|mixed|string
 * @throws Exception
 */
function httpCurl($url, $type='get', $res='', $data=''){
    // 1.初始化
    $ch = curl_init();
    // 2.设置参数
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    if($type == 'post'){
        // 如果是post请求的话,设置post的一些参数
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch , CURLOPT_POST , true);
        curl_setopt($ch , CURLOPT_POSTFIELDS, $data);
        curl_setopt ( $ch, CURLOPT_HEADER, false );
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


/**
 * Notes: xml转数组
 * Created by lxj at 2020/8/24 10:09
 * @param $xml
 * @return mixed
 */
function xmlToArray($xml)
{
    //将XML转为array
    return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
}
