<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/21
 * Time: 17:43
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $autoWriteTimestamp = 'datetime';

    public function getSnapItemsAttr($value){
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }

    public function getSnapAddressAttr($value){
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }

    public static function getSummaryByUser($uid, $page = 1, $size = 15){
        $pageData = self::where('user_id', '=', $uid)->order('create_time desc')->paginate($size, true, ['page'=>$page]);
        return $pageData;
    }
}