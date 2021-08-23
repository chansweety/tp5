<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/14
 * Time: 22:09
 */

namespace app\Lib\exception;


class TokenException extends BaseException
{
    // HTTP 状态码
    public $code = 401;

    // 错误信息
    public $msg = 'Token已过期或无效Token';

    // 自定义错误码
    public $errorCode = 10001;
}