<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/6/22
 * Time: 22:46
 */

namespace app\Lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求banner不存在';
    public $errorCode = 40000;
}