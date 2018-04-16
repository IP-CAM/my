<?php
// +----------------------------------------------------------------------
// | ETshop [ Rapid development framework for Cross border Mall ]
// +----------------------------------------------------------------------
// 版权所有 @ 深圳市润土信息技术有限公司 禁止任何企业和个人对程序代码以任何形式任何目的再发布。
// +----------------------------------------------------------------------
// | Copyright (c) 2015~2017 http://www.runtuer.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: theseaer <theseaer@qq.com>
// +----------------------------------------------------------------------
// | 售后原因  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use app\admin\controller\Admin;

class Reason extends Admin
{
    
    /**
     * @Mark:单品统计
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/11/15
     */
    public function index()
    {
        $this->assign("_total", 100);
        $this->assign("_enable", 100);
        $this->assign("meta_title", lang('Reason'));
        return $this->fetch();
    }
    
}