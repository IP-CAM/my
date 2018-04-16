<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Pointtopick.php  Version 2017/3/29  运营日志
// +----------------------------------------------------------------------
namespace app\promotion\controller\admin;

use app\admin\controller\Admin;

class Pointtopick extends Admin
{
    /**
     * @Mark:积分兑换提供券
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/4/3
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Pointtopick'));
        $this->assign('_total', 100);
        return $this->fetch();
    }
}