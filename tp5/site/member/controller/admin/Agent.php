<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Agent.php  Version 2017/4/1 代理商
// +----------------------------------------------------------------------
namespace app\member\controller\admin;

use app\admin\controller\Admin;

class Agent extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/25
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->meta_title  = lang('Agentsys');
    }
    
    //TODO 来自继承的功能，且已完成 by theseaer start 2017/7/24
}