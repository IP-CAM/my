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
// | Crm.php  Version 2017/3/20 微型CRM客户管理
// +----------------------------------------------------------------------
namespace app\finance\controller\admin;

use app\admin\controller\Admin;

class Crm extends Admin
{
    /**
     * @Mark:微型CRM首页
     * @return mixed
     * @Author: theseaer <theseaer@qq.com>
     * @Version 2017/3/20
     */
    public function index()
    {
        $this->assign('meta_title', lang('Fincrm'));
        return $this->fetch();
    }
}