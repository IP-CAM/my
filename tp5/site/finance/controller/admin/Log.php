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
// | Log.php  Version 2017/3/20 融租日志
// +----------------------------------------------------------------------
namespace app\finance\controller\admin;

use app\admin\controller\Admin;

class Log extends Admin
{
    /**
     * @Mark:日志首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    public function index()
    {
        $this->assign('meta_title', lang('Finlog'));
        return $this->fetch();
    }
}