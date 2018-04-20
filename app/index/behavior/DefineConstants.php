<?php
/**
 * Created by PhpStorm.
 * User: lenovo9
 * Date: 2017/3/7
 * Time: 16:52
 */
namespace app\index\behavior;
use think\Request;

class DefineConstants
{
    public function run(&$params)
    {
        $dispatch = $params->dispatch()['module'];
        define('MODULE_NAME', Request::instance()->module());
        define('CONTROLLER_NAME', $dispatch[1] ?: 'index');
        define('ACTION_NAME', $dispatch[2] ?: 'index');
    }
}
