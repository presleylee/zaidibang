<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/25
 * Time: 21:35
 */

namespace app\index\controller;


use think\Controller;

class Place extends Common
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->assign('css_list', ['place']);
        $this->active = [
            'index' => '',
            'intro' => '',
            'history' => '',
            'area' => '',
            'scenic' => '',
            'food' => '',
            'celebrity' => '',
            'school' => '',
            'company' => '',
        ];
        $this->assign('active', $this->active);
    }

    public function index()
    {
        $this->active['index'] = ' class="active"';
        $this->assign('active', $this->active);
        return view();
    }


    public function intro()
    {
        $this->active['intro'] = ' class="active"';
        $this->assign('active', $this->active);
        return view();
    }

    public function history()
    {
        $this->active['history'] = ' class="active"';
        $this->assign('active', $this->active);
        return view();
    }

    public function area()
    {
        $this->active['area'] = ' class="active"';
        $this->assign('active', $this->active);
        return view();
    }

    public function scenic()
    {
        $this->active['scenic'] = ' class="active"';
        $this->assign('active', $this->active);
        return view();
    }

    public function food()
    {
        $this->active['food'] = ' class="active"';
        $this->assign('active', $this->active);
        return view();
    }

    public function celebrity()
    {
        $this->active['celebrity'] = ' class="active"';
        $this->assign('active', $this->active);
        return view();
    }

    public function school()
    {
        $this->active['school'] = ' class="active"';
        $this->assign('active', $this->active);
        return view();
    }

    public function company()
    {
        $this->active['company'] = ' class="active"';
        $this->assign('active', $this->active);
        return view();
    }
}