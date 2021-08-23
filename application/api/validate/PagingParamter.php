<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/25
 * Time: 21:55
 */

namespace app\api\validate;


class PagingParamter extends BaseValidate
{
    protected $rule = [
        'page'  => 'isPositiveInteger',
        'size'  => 'isPositiveInteger',
    ];

    protected $message = [
        'page'  => '分页参数必须是正整数',
        'size'  => '分页参数必须是正整数',
    ];
}