<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::rule('index/:id', 'index/Index/index', 'post|get');
//Route::post('index/:id', 'index/Index/index');
Route::rule('test/:age', 'index/Index/test', 'post|get');
Route::rule('hello', 'sample/Test/hello');

Route::rule('banner/:version', 'api/:version.Banner/getBanner', 'post|get');

Route::rule('theme/:version','api/:version.Theme/getSimpleList','post|get');

Route::rule('token/:version/user','api/:version.Token/getToken','post');

Route::rule('api/:version/product','api/:version.Product/getAll','post|get');

Route::rule('api/:version/address', 'api/:version.Address/createOrUpdateAddress','post');

//Route::rule('api/:version/second','api/:version.Address/second','get');

Route::rule('api/:version/order','api/:version.Order/placeOrder','post|get');

Route::rule('api/:version/order/by_order', 'api/:version.Order/getSummaryByUser', 'post|get');