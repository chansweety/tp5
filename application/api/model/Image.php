<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/1
 * Time: 21:40
 */

namespace app\api\model;


use think\Model;

class Image extends BaseModel
{
    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}