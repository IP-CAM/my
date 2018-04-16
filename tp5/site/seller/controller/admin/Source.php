<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Source.php  Version 2017/6/30 想销商资源
// +----------------------------------------------------------------------
namespace app\seller\controller\admin;

use app\admin\controller\Admin;

class Source extends Admin
{
    /**
     * @Mark:想销商资源
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/30
     */
    public function index()
    {
        $this->assign('meta_title', lang('Goodsurc'));
        return $this->fetch();
    }
    
}