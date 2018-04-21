<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use  \think\Route;

Route::domain('admin','admin'); //二级域名绑定
Route::domain('m','mobile'); //二级域名绑定
//二级域名绑定
Route::domain('www', [
    'index' => 'index/index',
    '/' => 'index/index',
    '/place' => 'index/place/index',
    '/place/intro' => 'index/place/intro',
    '/place/history' => 'index/place/history',
    '/place/area' => 'index/place/area',
    '/place/scenic' => 'index/place/scenic',
    '/place/food' => 'index/place/food',
    '/place/celebrity' => 'index/place/celebrity',
    '/place/school' => 'index/place/school',
    '/place/company' => 'index/place/company',
]);

return [

//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],

];
