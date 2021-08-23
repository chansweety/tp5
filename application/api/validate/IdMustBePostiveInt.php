<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/6/21
 * Time: 21:40
 */

namespace app\api\validate;

class IdMustBePostiveInt extends BaseValidate
{
    protected $rule = [
        'id'    => 'require|isPositiveInteger',
    ];

    protected $message = [
        'id'    => 'id必须为正整数',
    ];
}