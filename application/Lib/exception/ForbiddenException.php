<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/20
 * Time: 15:15
 */

namespace app\Lib\exception;


class ForbiddenException extends BaseException
{
    // HTTP 状态码
    public $code = 403;

    // 错误信息
    public $msg = '权限不够';

    // 自定义错误码
    public $errorCode = 10001;
}