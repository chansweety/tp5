<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/20
 * Time: 21:36
 */

namespace app\api\validate;


use app\Lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{
    protected $rule = [
        'products'  => 'checkProducts',
    ];

    protected $singleRule = [
        'product_id'    => 'require|isPositiveInteger',
        'count'         => 'require|isPositiveInteger',
    ];

    protected function checkProducts($values){
        if(empty($values)){
            throw new ParameterException([
                'msg'   => '商品不能为空'
            ]);
        }

        if(!is_array($values)){
            throw new ParameterException([
                'msg'   => '商品参数不正确'
            ]);
        }

        foreach ($values as $key=>$value){
            $this->checkProduct($value);
        }
        return true;
    }

    protected function checkProduct($value){
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if(!$result){
            throw new ParameterException([
                'msg'   => '商品列表参数错误',
            ]);
        }
    }
}