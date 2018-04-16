<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Express.php  Version 2017/6/30 物流资源
// +----------------------------------------------------------------------
namespace app\seller\controller\admin;

use app\admin\controller\Admin;

class Express extends Admin
{
    /**
     * @Mark:商品资源
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/30
     */
    public function index()
    {
        $this->assign('meta_title', lang('Expresssurc'));
        return $this->fetch();
    }
}