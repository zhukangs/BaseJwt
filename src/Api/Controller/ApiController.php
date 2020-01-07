<?php
/**
 * Created by PhpStorm.
 * User: zhukang
 * Date: 2019/8/22
 * Time: 11:53
 */

namespace App\Http\Controllers\Api;

use App\Api\Helpers\ApiResponse;
use App\Api\Helpers\Jwt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use Jwt,ApiResponse;
    // 其他通用的Api帮助函数

    /**
     * 验证公共参数
     * @param object $request Request类
     * @param array $params 需要验证的参数
     * @return string 错误提示信息
     */
    public function verifyParams($request, $params)
    {
        $err_msg = '';

        $input = $request->all();
        // dd($input);
        foreach ($params as $k => $v) {
            if (!array_key_exists($v, $input)) {
                $err_msg .= '['.$v.'] ';
            }
        }

        if (!empty($err_msg))
            $err_msg .= '参数缺失';

        return $err_msg;
    }

    public function getFirstErr($errors)
    {
        $err_msg = '';
        foreach($errors as $key=>$value)
        {
            $err_msg = $value[0];
        }
        return $err_msg;
    }

}