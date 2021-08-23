<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/7
 * Time: 22:42
 */

namespace app\api\model;


class User  extends BaseModel
{
    public function address(){
        return $this->hasOne('Address','user_id','id');
    }

    public static function getByOpenID($openid){
        $user = self::where('openid', '=', $openid)->find();
        return $user;
    }
}