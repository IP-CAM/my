<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Custom.php  Version 2017/4/2
// +----------------------------------------------------------------------
namespace app\admin\controller;

class Custom extends Admin
{
    /**
     * @Mark:继承
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/7/31
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->index_where  =  '';
        $this->meta_title   =  lang('Customconf');
    }
}