<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Server.php  Version 2017/9/8
// +----------------------------------------------------------------------
namespace app\admin\controller;

class Server extends Admin
{
    /**
     * @Mark:服务列表
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/9/8
     */
    public function index()
    {
        $list = ''; //已安装的服务
        $this->assign('list', $list);
        $this->assign ("meta_title", lang('Servicelist'));
        return $this->fetch();
    }
    
    /**
     * @Mark:钩子市场
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/8/3
     */
    public function market()
    {
        $this->assign('list', '');
        $this->assign ("meta_title", lang('Sermarket'));
        $this->assign ('_total', 1000);
        $this->assign ('_installed', 5);
        $this->assign ('_waitup', 10);
        return $this->fetch();
    }
}