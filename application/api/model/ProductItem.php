<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/18
 * Time: 0:54
 */

namespace app\api\model;


class ProductItem extends BaseModel
{
    public function pItemEquipment(){
        return $this->hasMany('PItemEquipment','p_item_id','id');
    }
}