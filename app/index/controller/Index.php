<?php
namespace app\index\controller;

class Index extends Common
{
    public function _initialize()
    {
        parent::_initialize();
        $this->assign('css_list', ['index']);
    }

    public function index()
    {

        return view();
    }
}
