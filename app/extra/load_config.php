<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/20
 * Time: 21:42
 */

define('ENVIRONMENT', 'develop');
$load_config = include_once(APP_PATH . ENVIRONMENT . '.php');
return $load_config;