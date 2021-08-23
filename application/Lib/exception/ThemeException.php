<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/6
 * Time: 22:02
 */

namespace app\Lib\exception;


class ThemeException extends BaseException
{
    // HTTP 状态码
    public $code = 404;

    // 错误信息
    public $msg = '请求主题不存在';

    // 自定义错误码
    public $errorCode = 30000;
}