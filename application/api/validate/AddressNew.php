<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/19
 * Time: 15:43
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule = [
        'name'      => 'require|isNotEmpty',
        'mobile'    => 'require|isMobile',
        'province'  => 'require|isNotEmpty',
        'city'      => 'require|isNotEmpty',
        'country'   => 'require|isNotEmpty',
        'detail'    => 'require|isNotEmpty',
    ];
}