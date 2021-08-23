<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/22
 * Time: 22:37
 */

namespace app\api\service;


use think\Exception;
use think\Loader;

// 手动加载无法使用命名空间的扩展类
Loader::import('WxPay.Wxpay', EXTEND_PATH, '.Api.php');

class Pay
{
    private $orderID;
    private $orderNo;

    function __construct($orderID)
    {
        if(!$orderID){
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID = $orderID;
    }

    public function pay(){
        $orderService = new Order();
    }
}