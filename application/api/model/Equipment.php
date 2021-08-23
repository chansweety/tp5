<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/18
 * Time: 1:00
 */

namespace app\api\model;


class Equipment extends BaseModel
{
    public function pItemEquipment(){
        return $this->hasMany('PItemEquipment','e_id','id');
    }
}