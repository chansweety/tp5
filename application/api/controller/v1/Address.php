<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/19
 * Time: 15:48
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\Lib\exception\UserException;

class Address extends BaseController
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only'=>'createOrUpdateAddress']
    ];
    
    /*protected $beforeActionList = [
        'first' => ['only'=>'second'],
    ];

    public function first(){
        echo 'first';
    }

    public function second(){
        echo 'second';
    }*/

    public function createOrUpdateAddress(){
        $vaildate = new AddressNew();
        $vaildate->goCheck();
        //根据Token获取uid
        //根据uid查找用户信息，判断用户是否存在，如果不存在抛出异常
        //获取用户从客户端提交的地址信息
        //根据用户地址信息是否存在，判断是添加地址还是更改地址

        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }

        $dataArray = $vaildate->getDataByRule(input('post.'));

        $userAddress = $user->address;
        if(!$userAddress){
            $user->address()->save($dataArray);
        }else{
            $user->address->save($dataArray);
        }
        return 'success';
    }
}