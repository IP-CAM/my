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
// | 物流集运中心  Version 1.0 2017/1/19
// +----------------------------------------------------------------------
namespace app\logistics\controller\admin;

use app\admin\controller\Admin;

class Optimize extends Admin
{
    
    /**
     * @Mark:
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/1/19
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Loptimize'));
        return $this->fetch();
    }
}