<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Action.php  Version 2017/3/27 行为管理
// +----------------------------------------------------------------------
namespace app\admin\controller;

class Action extends Admin
{
    
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/31
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->meta_title = lang('Useraction');
    }
    
    /**
     * @Mark:用户动作删除
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/27
     */
    public function deleteaction()
    {
        $this->controller_name = 'Action';
        parent::delete();
    }
}