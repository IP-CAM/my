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
// | 定时任务管理  Version 1.0  2016/3/14
// +----------------------------------------------------------------------

namespace app\systems\controller\admin;
use app\admin\controller\Admin;

class Words extends Admin
{

    /**
     * @Mark:首页
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2016/10/8
     */
    public function index()
    {
        $this->assign ("meta_title", lang('Words'));
        return $this->fetch();
    }
}