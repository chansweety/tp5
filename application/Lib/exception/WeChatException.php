<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/13
 * Time: 15:27
 */

namespace app\Lib\exception;


class WeChatException extends BaseException
{
    // HTTP 状态码
    public $code = 400;

    // 错误信息
    public $msg = '微信服务器接口调用失败';

    // 自定义错误码
    public $errorCode = 999;
}