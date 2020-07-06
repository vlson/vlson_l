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
