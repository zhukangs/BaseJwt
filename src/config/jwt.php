<?php
/**
 * Created by PhpStorm.
 * User: zhukang.
 * Date: 2020/1/6.
 * Time: 17:57.
 */

return [
    // 使用HMAC生成信息摘要时所使用的密钥
    'key' => env('JWT_KEY','zkapi'),

    // access token过期秒数(默认15分钟)
    'access_exp' => env('JWT_ACCESS_EXP',900),

    // refresh token过期秒数(默认2小时)
    'refresh_exp' => env('JWT_REFRESH_EXP',7200),
];