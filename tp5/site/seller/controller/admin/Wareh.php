<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Wareh.php  Version 2017/6/30 仓储资源
// +----------------------------------------------------------------------
namespace app\seller\controller\admin;

use app\admin\controller\Admin;

class Wareh extends Admin
{
    /**
     * @Mark:商品资源
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/30
     */
    public function index()
    {
        $this->assign('meta_title', lang('Warehsurc'));
        return $this->fetch();
    }
}