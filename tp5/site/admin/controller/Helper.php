<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Helper.php  Version 2017/5/18  二开帮助手册
// +----------------------------------------------------------------------
namespace app\admin\controller;

class Helper extends Admin
{
    /**
     * @Mark:开发者帮助手册
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/5/18
     */
    public function index()
    {
        $langs = include realpath(RUNTIME_PATH . '/lang/'.$this->lang.'.php');
        $this->assign('meta_title', lang('Cmfhelper'));
        $this->assign('langs', $langs);
        $this->assign('data', null);
        return $this->fetch();
    }
}