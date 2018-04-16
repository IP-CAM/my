<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | Log.php  Version 2017/3/29  运营日志
// +----------------------------------------------------------------------
namespace app\promotion\controller\admin;

use app\admin\controller\Admin;

class Log extends Admin
{
    /**
     * @Mark:优惠券使用日志
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/4/3
     */
    public function index()
    {
        $this->assign('meta_title', lang('Couponslog'));
        $this->assign('_total', 100);
        return $this->fetch();
    }
    
    /**
     * @Mark:实体券日志
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/4/3
     */
    public function pick()
    {
        $this->assign('meta_title', lang('Picklog'));
        $this->assign('_total', 100);
        return $this->fetch();
    }
}