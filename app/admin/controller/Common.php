<?php
/**
 * Created by PhpStorm.
 * User: camellias
 * Date: 2016/12/6
 * Time: 16:01
 */

namespace app\admin\controller;


use think\Controller;
use think\Session;
use think\Cookie;
use think\Request;
use think\config;
use think\Db;
use Rbac;



class Common extends Controller
{
    public function _initialize()
    {
        $current_host = Request::instance()->host();
        $host_array = explode('.', $current_host);
        $this->alias = strtolower( reset($host_array) );

        if ( config('domain')['admin_prefix'] != $this->alias && ACTION_NAME != 'no_page' ) {
            $this->_404();
        }

        $this->checkLogin();

        //in_array(MODULE_NAME, explode(',', config('NOT_AUTH_MODULE')));//||
        //$not_auth = in_array(ACTION_NAME, explode(',', config('NOT_AUTH_ACTION')));
        $not_auth_arr = config('NOT_AUTH');
        $not_auth = 0;
        if ( isset( $not_auth_arr[ strtolower(CONTROLLER_NAME) ] ) ) {
            $not_auth = in_array(strtolower(ACTION_NAME), $not_auth_arr[strtolower(CONTROLLER_NAME)]);
        }

        $this->assign('css_version', config('css_version') ? : substr(time(),0, 6));

    }

    public function submitcheck()
    {
        $dosubmit = cookie('submit');
        if (time() - $dosubmit < 10) {
            message('操作失败，您提交次数过快', 3);
        }
        cookie('submit', time());
    }

    public function _empty()
    {

    }

    private function checkLogin() {

        $user_id = Session::get( config('USER_AUTH_KEY') );
        $this->userinfo = $admin_user = Cookie::get('admin_user');
        if ( (!$user_id || !$admin_user) && (strtolower(CONTROLLER_NAME) != 'index' && !in_array(ACTION_NAME, ['login', 'no_page', 'getArea'])) ) {
            $this->redirect('index/login');
        }

    }

    private function _404() {
         $weburl = 'http://' . config('MAN_DOMAIN_PERFIX') . '.' . config('DOMAIN_SUFFIX');
        $this->redirect('index/no_page', 404);
    }
}