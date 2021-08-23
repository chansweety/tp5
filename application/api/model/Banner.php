<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/6/22
 * Time: 22:00
 */

namespace app\api\model;


use think\Db;
use think\Exception;
use think\Model;

class Banner extends BaseModel
{
//    protected $hidden = ['delete_time'];
//    protected $table = 'banner_item';
    public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerById($id)
    {
        return self::with(['items','items.img'])->find($id);
//        $res = Db::query('select * from `banner_item` where id=?', [$id]);
//        return $res;
//        $res = Db::table('banner_item')->where('id', '>', $id)->select();
//        $res = Db::table('banner_item')
////            ->fetchSql()
//            ->where(function ($query) use ($id){
//            $query->where('id', '>=', $id);
//        })
//            ->select();
//        return $res;
    }
}