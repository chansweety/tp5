<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/6
 * Time: 21:28
 */

namespace app\api\validate;


class IDCollection  extends BaseValidate
{
    protected $rule = [
        'ids'   => 'require|checkIDs'
    ];

    protected $message = [
        'ids'   => 'id参数必须是以逗号分隔的多个正整数'
    ];

    protected function checkIDs($value)
    {
        $value = explode(',', $value);
        if(empty($value)){
            return false;
        }
        foreach ($value as $id){
            if(!$this->isPositiveInteger($id)){
                return false;
            }
        }
        return true;
    }
}