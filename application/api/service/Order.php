<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/20
 * Time: 21:56
 */

namespace app\api\service;


use app\api\model\Product;
use app\Lib\exception\OrderException;
use app\api\model\Address as AddressModel;
use app\Lib\exception\UserException;
use app\api\model\Order as OrderModel;
use think\Db;
use think\Exception;

class Order
{
    //客户端传递参数
    protected $oProducts;

    //真实的商品信息（包括库存量）
    protected $products;

    protected $uid;

    public function place($uid, $oProducts){
        //oProducts 和 products作对比
        //products 从数据库中查询出来
        $this->oProducts = $oProducts;
        $this->uid = $uid;
        $this->products = $this->getProductsByOrder($oProducts);
        $status = $this->getOrderStatus();
        if(!$status['pass']){
            $status['order_id'] = -1;
            return $status;
        }

        $orderSnap = $this->snapOrder($status);
        $order = $this->createOrder($orderSnap);
        $order['pass'] = true;
        return $order;
    }

    public function checkOrderStock($orderID){
        
    }

    private function createOrder($snap){
        // 事务处理
        Db::startTrans();
        try {
            $orderNo = self::makeOrderNo();
            $order = new OrderModel();
            $order->user_id = $this->uid;
            $order->order_no = $orderNo;
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['totalCount'];
            $order->snap_name = $snap['snapName'];
            $order->snap_address = $snap['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);

            $order->save();

            $create_time = $order->create_time;
            $orderID = $order->id;
            foreach($this->oProducts as &$p){
                $p['order_id'] = $orderID;
            }

            Db::commit();
            return [
                'order_no'      => $orderNo,
                'order_id'      => $orderID,
                'create_time'   => $create_time,
            ];
        }catch (Exception $ex){
            Db::rollback();
            throw $ex;
        }
    }

    public static function makeOrderNo(){
        $yCode = ['A','B','C','D','E','F','G','H','I','J'];
        $orderSn = $yCode[intval(date('Y')) - 2021] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 3) . sprintf('%02d', rand(0,99));
        return $orderSn;
    }

    //生成订单快照
    private function snapOrder($staus){
        $snap = [
            'orderPrice'    => 0,
            'totalCount'    => 0,
            'pStatus'       => [],
            'snapAddress'   => '',
            'snapName'      => '',
            'snapImg'       => '',
        ];

        $snap['orderPrice'] = $staus['orderPrice'];
        $snap['totalCount'] = $staus['totalCount'];
        $snap['pStatus'] = $staus['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];

        if(count($this->products) > 1){
            $snap['snapName'] .= '等';
        }
    }

    private function getUserAddress(){
        $userAddress = AddressModel::where('user_id','=', $this->uid)->find();
        if(!$userAddress){
            throw new UserException([
                'msg'       => '用户地址不存在，下单失败',
                'errorCode' => 60001,
            ]);
        }
        return $userAddress->toArray();
    }

    private function getOrderStatus(){
        $status = [
            'pass'          => true,
            'orderPrice'    => 0,
            'totalCount'    => 0,
            'pStatusArray'  => [],
        ];

        foreach ($this->oProducts as $oProduct) {
            $pStatus = $this->getProductStatus($oProduct['product_id'], $oProduct['count'], $this->products);
            if(!$pStatus['haveStock']){
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            $status['totalCount'] += $pStatus['count'];
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }

    private function getProductStatus($oPID, $oCount, $products){
        $pIndex = -1;
        $pStatus = [
            'id'            => null,
            'haveStock'     => false,
            'count'         => 0,
            'name'          => '',
            'totalPrice'    => 0,
        ];
        for ($i = 0; $i < count($products); $i++){
            if($oPID == $products[$i]['id']){
                $pIndex = $i;
            }
        }

        if($pIndex == -1){
            throw new OrderException([
                'msg'   => 'id为'.$oPID.'商品不存在，创建订单失败',
            ]);
        }else{
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['count'] = $oCount;
            $pStatus['name'] = $product['name'];
            $pStatus['totalPrice'] = $product['price'] * $oCount;

            if($product['num'] - $oCount >= 0){
                $pStatus['haveStock'] = true;
            }
            return $pStatus;
        }
    }

    private function getProductsByOrder($oProducts){
        $oPIDs = [];
        foreach ($oProducts as $item) {
            array_push($oPIDs, $item['product_id']);
        }
        $product = Product::all($oPIDs)->visible(['id','name','num','price'])->toArray();
        return $product;
    }
}