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
use think\Db;
use Rbac;


class Common extends Controller
{
    public function _initialize()
    {
        $current_host = Request::instance()->host();
        $host_array = explode('.', $current_host);
        $this->alias = strtolower( reset($host_array) );
        if ( config('ADMIN_PREFIX') != $this->alias && ACTION_NAME != 'no_page' ) {
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

        if (config('USER_AUTH_ON') && !$not_auth) {
            //是否权限认证
            if (!Rbac::AccessDecision()) {

                if (request()->isAjax()) {
                    return json(['status' => 0,  'msg' => '没有操作权限']);
                } else {
                    // 没有权限 抛出错误
                    if (config('RBAC_ERROR_PAGE')) {
                        $this->redirect(config('RBAC_ERROR_PAGE'));// 定义权限错误页面
                    } else {
                        // 提示错误信息
                        message('没有操作权限', 3);
                    }
                }
            }
        }

        $menu = [];

        $admin_user = cookie('admin_user');
        $this->assign('userinfo', $admin_user);
        $this->assign('leftMenu',list_to_tree($menu));
        $this->assign('staticUrl',config('static_url'));
        $this->assign('resUrl', config('RES_URL'));
        $this->assign('bootUrl', config('BOOT_URL'));

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