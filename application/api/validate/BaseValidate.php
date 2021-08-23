<?php
/**
 * Create by PhpStorm
 * User: Chan
 * Date: 2021/6/21
 * Time: 22:10
 */

namespace app\api\validate;

use app\Lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $request = Request::instance();
        $params = $request->param();

        $res = $this->batch()->check($params);
        if(!$res){
            $e = new ParameterException([
              'msg'         => $this->error,
              //'code'        => 400,
              //'errorCode'   => 10000,
            ]);
            //$e->msg = $this->error;
            throw $e;
//            $error = $this->error;
//            throw new Exception($error);
        }else{
            return true;
        }
    }

    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '')
    {
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
            return true;
        }else{
//            return $field.'必须为正整数';
            return false;
        }
    }

    protected function isNotEmpty($value, $rule = '', $data = '', $field = ''){
        if(empty($value)){
            return false;
        }else{
            return true;
        }
    }

    protected function isMobile($value){
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function getDataByRule($arrays){
        if(array_key_exists('user_id',$arrays) || array_key_exists('uid',$arrays)){
            throw new ParameterException([
                'msg'   => '参数包含非法参数名user_id或uid',
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $k=>$v){
            $newArray[$k] = $arrays[$k];
        }
        return $newArray;
    }
}