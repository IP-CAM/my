<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Appwatch.php  Version 2017/6/27 用户体验监控
// +----------------------------------------------------------------------
namespace app\systems\controller\admin;

use app\admin\controller\Admin;

class User extends Admin
{
    /**
     * @Mark:监控列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/27
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Userwatch'));
        return $this->fetch();
    }
}