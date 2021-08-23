<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/6/23
 * Time: 22:56
 */

namespace app\Lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}