<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/7
 * Time: 22:39
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token extends \app\api\service\Token
{
    public function getToken($code=''){
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        return [
            'token' => $token,
        ];
    }
}