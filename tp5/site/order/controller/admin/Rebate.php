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
// | 退货退款  Version 1.0  2016/3/13
// +----------------------------------------------------------------------
namespace app\order\controller\admin;

use app\admin\controller\Admin;

class Rebate extends Admin
{
    
    public function index(){
        $this->assign ("meta_title", lang('Report'));
        return $this->fetch();
    }
}