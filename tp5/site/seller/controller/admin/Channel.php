<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Channel.php  Version 2017/6/30 渠道资源
// +----------------------------------------------------------------------
namespace app\seller\controller\admin;

use app\admin\controller\Admin;

class Channel extends Admin
{
    /**
     * @Mark:商品资源
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/6/30
     */
    public function index()
    {
        $this->assign('meta_title', lang('Channelsurc'));
        return $this->fetch();
    }
}