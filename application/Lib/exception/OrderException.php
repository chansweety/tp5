<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/21
 * Time: 15:13
 */

namespace app\Lib\exception;


class OrderException extends BaseException
{
    // HTTP 状态码
    public $code = 404;

    // 错误信息
    public $msg = '订单不存在，请检查ID';

    // 自定义错误码
    public $errorCode = 80000;
}