<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Pickup.php  Version 2017/3/27  提货券
// +----------------------------------------------------------------------
namespace app\promotion\controller\admin;

use app\admin\controller\Admin;

class Pickup extends Admin
{
    public function index()
    {
        $this->assign('meta_title', lang('Pickup'));
        $this->assign('_total', 10);
        return $this->fetch();
    }
}