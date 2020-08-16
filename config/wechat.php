<?php
return [
    'official' => [
        'appId' => env('WECHAT_OFFICIAL_APPID'),
        'appSecret' => env('WECHAT_OFFICIAL_AppSecret'),
        'token' => env('WECHAT_OFFICIAL_TOKEN'),
        'menu' => [
            "button" => [
                // 左侧菜单栏
                [
                    "name" => "举个栗子",
                    "sub_button" => [
                        [
                            "type" => "scancode_waitmsg",
                            "name" => "扫一扫",
                            "key" => "scan_code",
                        ],
                        [
                            "type" => "location_select",
                            "name" => "发送位置",
                            "key" => "location",
                        ],
                    ],
                ],
                // 中间菜单栏
                [
                    "type" => "pic_photo_or_album",
                    "name" => "SHOW ME",
                    "key" => "pic_photo",
                ],
                // 右侧菜单栏
                [
                    "name" => "微醺",
                    "sub_button" => [
                        [
                            "type" => "click",
                            "name" => "最近文章",
                            "key" => "latest_article"
                        ],
                        [
                            "type" => "view",
                            "name" => "工具",
                            "key" => "tools",
                            "url" => "http://tools.vlson.top"
                        ],
                        [
                            "type" => "view",
                            "name" => "主站",
                            "key" => "www",
                            "url" => "http://www.vlson.top"
                        ],
                    ]
                ],
            ],
        ],
    ]
];
