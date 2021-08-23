<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/7
 * Time: 22:43
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        'code'  => 'require|isNotEmpty',
    ];

    protected $message = [
        'code'  => '没有code还想要token，做梦哦',
    ];
}