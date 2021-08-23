<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/5
 * Time: 22:44
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\Lib\exception\ThemeException;
use app\api\model\Theme as ThemeModel;

class Theme
{
    /*
     * @url /theme?id=id1,id2,id3...
     * @return 一组theme模型
     * */
    public function getSimpleList($ids='')
    {
        (new IDCollection())->goCheck();
        $result = ThemeModel::getTheme();
        if(!$result){
            throw new ThemeException();
        }else{
            return 'success';
        }
    }

    /**
     * @param $id
     */
    public function getComplexOne($id){

    }
}