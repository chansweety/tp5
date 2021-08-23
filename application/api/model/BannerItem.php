<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/1
 * Time: 21:14
 */

namespace app\api\model;


use think\model;

class BannerItem extends BaseModel
{
    public function img()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}