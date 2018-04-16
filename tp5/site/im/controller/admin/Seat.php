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
// | Seat.php  Version 2017/3/13 客服席位管理
// +----------------------------------------------------------------------
namespace app\im\controller\admin;

use app\admin\controller\Admin;

class Seat extends Admin
{
    
    /**
     * @Mark:席位管理首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/13
     */
    public function index()
    {
        $this->assign('meta_title', lang('Imseat'));
        $this->assign('data', null);
        return $this->fetch();
    }
}