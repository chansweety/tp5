<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/5
 * Time: 22:45
 */

namespace app\api\model;


class Product extends BaseModel
{
    public static function getAll(){
        return self::with(['itemEquipment'])->with(['itemEquipment'=>function($query){
            $query->with(['pItemEquipment'])->order('p_id','desc');
        }])->select();
    }

    public function itemEquipment(){
        return $this->hasMany('ProductItem','p_id','id');
    }

    public static function getProductDetail(){

    }
}