<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Navs.php  Version 2017/9/25 导航管理
// +----------------------------------------------------------------------
namespace app\index\controller\admin;

use app\admin\controller\Admin;

class Navs extends Admin
{
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/25
     */
    public function index()
    {
        $this->assign('meta_title', lang('Indexnav'));
        return $this->fetch();
    }
}