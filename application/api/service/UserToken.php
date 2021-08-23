<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/7
 * Time: 22:57
 */

namespace app\api\service;


use app\Lib\enum\ScopeEnum;
use app\Lib\exception\TokenException;
use app\Lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppID,$this->wxAppSecret,$this->code);
    }

    public function get(){
        $result = geturl($this->wxLoginUrl);
        if(empty($result)){
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }else{
            $loginFail = array_key_exists('errcode', $result);
            if($loginFail){
                $this->processLoginErr($result);
            }else{
                return $this->grantToken($result);
            }
        }
    }

    private function grantToken($result){
        //拿到openid
        //数据库查看是否存在
        //如果存在不处理，如果不存在新增一条user记录
        //生成令牌，存入缓存
        //返回令牌到客户端
        $user = UserModel::getByOpenID($result['openid']);
        if($user){
            $uid = $user->id;
        }else{
            $uid = $this->newUser($result['openid']);
        }
        $cacheValue = $this->prepareCacheValue($result, $uid);
        $token = $this->saveToCache($cacheValue);
        return $token;

    }

    private function saveToCache($cacheValue){
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        $expire_in = config('setting.token_expire_in');

        $request = cache($key, $value, $expire_in);
        if(!$request){
            throw new TokenException([
                'msg'       => '服务器错误',
                'errorCode' => 10005,
            ]);
        }
        return $key;
    }

    private function prepareCacheValue($result, $uid){
        $cacheValue = $result;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = ScopeEnum::User;
        return $cacheValue;
    }

    private function newUser($openid){
        $user = UserModel::create([
            'openid'    => $openid,
        ]);
        return $user->id;
    }

    private function processLoginErr($result){
        throw new WeChatException([
            'msg'       => $result['errmsg'],
            'errorCode' => $result['errcode'],
        ]);
    }
}