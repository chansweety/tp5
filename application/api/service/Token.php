<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/7/13
 * Time: 16:34
 */

namespace app\api\service;


use app\Lib\enum\ScopeEnum;
use app\Lib\exception\ForbiddenException;
use app\Lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    public static function generateToken(){
        $randChars = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME'];
        $salt = config('secure.token_salt');

        return md5($randChars.$timestamp.$salt);
    }

    public static function getCurrentTokenVar($key){
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if(!$vars){
            throw new TokenException();
        }else{
            if(!is_array($vars)){
                $vars = json_decode($vars,true);
            }
            if(array_key_exists($key,$vars)){
                return $vars[$key];
            }else{
                throw new Exception('尝试获取token变量不存在');
            }
        }
    }

    public static function getCurrentUid(){
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }

    public static function needPrimaryScope(){
        $scope = self::getCurrentTokenVar('scope');
        if($scope >= ScopeEnum::User){
            return true;
        }else{
            throw new ForbiddenException();
        }
    }

    public static function needExclusiveScope(){
        $scope = self::getCurrentTokenVar('scope');
        if($scope == ScopeEnum::User){
            return true;
        }else{
            throw new ForbiddenException();
        }
    }
}