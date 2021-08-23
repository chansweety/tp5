<?php
namespace app\index\controller;
use think\Request;
class Index
{
    public function index($id, $name, $age)
    {
        echo $id."_".$name.'_'.$age;
    }

    public function test()
    {
        $all = input('param.');
        var_dump($all);
//        $id = Request::instance()->param('id');
//        $name = Request::instance()->param('name');
//        $age = Request::instance()->param('age');
//        echo $id.'|'.$name.'|'.$age.'<br />';
//        $all = Request::instance()->param();
//        var_dump($all);
//        $id = Request::instance()->get();
//        $name = Request::instance()->post();
//        $age = Request::instance()->route();
//        echo $id['id'].'|'.$name['name'].'|'.$age['age'].'<br />';
//        var_dump($id);
//        echo '<br />';
//        var_dump($name);
//        echo '<br />';
//        var_dump($age);
//        echo '<br />';
    }
}
