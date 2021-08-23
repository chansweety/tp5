<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/6/16
 * Time: 22:06
 */

namespace app\api\controller\v1;

use app\api\validate\IdMustBePostiveInt;
use app\Lib\exception\BannerMissException;
use think\Exception;
use think\Validate;
use think\Request;
use app\api\model\Banner as BannerModel;

class Banner
{
    public function getBanner(){
        //独立验证
//        $data = [
//            'name'  => 'chan213',
//            'email' => 'chan_sweety163.com'
//        ];
//
//        $validate = new Validate([
//            'name'  => 'require|max:6',
//            'email' => 'email'
//        ]);
//
//        $res = $validate->batch()->check($data);
//        $err = $validate->getError();
//        var_dump($err);

        (new IdMustBePostiveInt())->goCheck();
        $id = Request::instance()->param('id');
//        $data = [
//            'id'    => $id,
//        ];
//
//        $validate = new IdMustBePostiveInt();
//        $res = $validate->batch()->check($data);
//        if($res){
//            return 'no problem';
//        }else{
//            return 'error';
//        }
//        try {
            $banner = BannerModel::getBannerById($id);
//            $banner->hidden(['delete_time']);
//            $banner->visible(['id','name']);

//            $banner = BannerModel::with(['items','items.img'])->find($id);
//        }catch (Exception $ex){
//            $err = [
//                'error_code'    => 10001,
//                'msg'           => $ex->getMessage(),
//            ];
//            return json($err,400);
//        }
        if(!$banner){
            throw  new BannerMissException();
        }
        return $banner;
    }
}