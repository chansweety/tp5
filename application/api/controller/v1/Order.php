<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/20
 * Time: 15:25
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\IdMustBePostiveInt;
use app\api\validate\OrderPlace;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
use app\api\validate\PagingParamter;
use app\api\model\Order as OrderModel;
use app\Lib\exception\OrderException;

class Order extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope'   => ['only'=>'placeOrder'],
        'checkPrimaryScope'     => ['only'=>'getSummaryByUser,getDetail'],
    ];

    public function getSummaryByUser($page = 1, $size = 15){
        (new PagingParamter())->goCheck();
        $uid = TokenService::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByUser($uid, $page, $size);
        if($pagingOrders->isEmpty()){
            return [
                'data'          => [],
                'current_page'  => $pagingOrders->getCurrentPage(),
            ];
        }
        $data = $pagingOrders->toArray();
        return [
            'data'          => $data,
            'current_page'  => $pagingOrders->getCurrentPage(),
        ];
    }

    public function getDetail($id){
        (new IdMustBePostiveInt())->goCheck();
        $orderDetail = OrderModel::get($id);
        if(!$orderDetail){
            throw new OrderException();
        }
        return $orderDetail;
    }

    public function placeOrder(){

//        $arr = [
//            'products' => [
//                ['product_id'=>1,'count'=>2],
//                ['product_id'=>3,'count'=>7],
//                ['product_id'=>5,'count'=>9],
//            ]
//        ];
//        return $arr;
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();

        $order = new OrderService();
        $status = $order->place($uid, $products);
        return $status;
    }
}