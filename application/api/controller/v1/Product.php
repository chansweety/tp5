<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/17
 * Time: 21:27
 */

namespace app\api\controller\v1;


use app\api\validate\IdMustBePostiveInt;
use app\api\model\Product as ProductModel;
use app\Lib\exception\ProductException;

class Product
{
    public function getAll(){
        $result = ProductModel::getAll();
        if(!$result){
            throw new ProductException();
        }
        return $result;
    }

    public function getOne($id){
        (new IdMustBePostiveInt())->goCheck();
    }
}