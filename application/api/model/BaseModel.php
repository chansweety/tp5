<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/1
 * Time: 22:35
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{
    protected function prefixImgUrl($value, $data)
    {
        $imgUrl = $value;
        if($data['from'] == 1){
            $imgUrl = config('setting.img_prefix').$value;
        }
        return $imgUrl;
    }
}