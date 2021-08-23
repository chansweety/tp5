<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/19
 * Time: 16:05
 */

namespace app\Lib\exception;


class UserException extends BaseException
{
    // HTTP 状态码
    public $code = 404;

    // 错误信息
    public $msg = '用户不存在';

    // 自定义错误码
    public $errorCode = 60000;
}