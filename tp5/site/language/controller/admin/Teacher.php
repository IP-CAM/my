<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Teacher.php  Version 2017/7/31  师资管理
// +----------------------------------------------------------------------
namespace app\language\controller\admin;

use app\admin\controller\Admin;

class Teacher extends Admin
{
    public function index()
    {
        $input  = $this->request->param();
        $item   = isset($input['item']) ? trim($input['item']) : '';
        $prom   = isset($input['prom']) ? trim($input['prom']) : '';
        $source = isset($input['source']) ? trim($input['source']) : '';
    
        $option = null;
        $this->assign('meta_title', lang('Teaclass'));
        $this->assign('option', $option);
        $this->assign('item', $item);
        $this->assign('prom', $prom);
        $this->assign('source', $source);
        $this->assign('_total', 0);
        return $this->fetch();
    }
}