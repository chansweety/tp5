<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/22
 * Time: 22:23
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'needExclusiveScope'    => ['only'=>'getPreOrder']
    ];

    public function getPreOrder(){

    }
}