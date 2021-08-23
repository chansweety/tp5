<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/18
 * Time: 1:08
 */

namespace app\Lib\exception;


class ProductException extends BaseException
{
    // HTTP 状态码
    public $code = 404;

    // 错误信息
    public $msg = '商品不存在';

    // 自定义错误码
    public $errorCode = 50000;
}