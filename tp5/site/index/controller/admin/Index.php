<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Index.php  Version 2017/9/25 首页控制器
// +----------------------------------------------------------------------
namespace app\index\controller\admin;

use app\admin\controller\Admin;

class Index extends Admin
{
    /**
     * @Mark:首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/25
     */
    public function index()
    {
        $this->assign('meta_title', lang('Indexs'));
        return $this->fetch();
    }
}